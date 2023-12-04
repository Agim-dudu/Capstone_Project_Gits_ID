<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payment;
use App\Models\Perusahaan;
use App\Models\PaymentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('name', 'email', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->get();

        return view('admin.transaction.index', ['users' => $results]);
    }

    public function index()
    {
        $perusahaans = Perusahaan::all();
        $users = User::all();
        $details = PaymentItem::all();
        $payments = Payment::all();


        return view('admin.transaction.index', compact('details', 'perusahaans', 'users', 'payments'));
    }

    public function edit($userId, $paymentId)
    {
        $user = User::findOrFail($userId);
        $payment = Payment::findOrFail($paymentId);

        return view('admin.transaction.edit', compact('user', 'payment'));
    }

    public function update(Request $request, $orderId)
    {
        $payment = Payment::findOrFail($orderId);

        // Validate and update the desired columns
        $request->validate([
            'ongkir' => 'required|numeric',
            'service' => 'required|string',
            'gross_amount' => 'required|numeric',
            'resi' => 'nullable|string', // You can adjust the validation rules accordingly
            'status' => 'required|string',
        ]);

        $payment->update([
            'ongkir' => $request->input('ongkir'),
            'service' => $request->input('service'),
            'gross_amount' => $request->input('gross_amount'),
            'resi' => $request->input('resi'),
            'status' => $request->input('status'),
        ]);


        return redirect()->route('role.admin.transactions')->with('success', 'Data Transaksi Berhasil di Update');
    }

    public function destroy($orderId)
    {
        $payment = Payment::findOrFail($orderId);

        $payment->delete();
        return redirect()->route('role.admin.transactions')->with('success', 'Data Transaksi Berhasil di Hapus');
    }

    public function exportTransaction()
    {
        $payments = Payment::with(['customer', 'seller', 'items', 'products'])->get();
        return Excel::download(new TransactionsExport($payments), 'transactions.xlsx');
    }

    public function DownloadTransactionPDF()
    {
        $perusahaans = Perusahaan::all();
        $users = User::all();
        $details = PaymentItem::all();
        $payments = Payment::all();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.transaction.pdf', compact('details', 'perusahaans', 'users', 'payments'))->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('transaction.pdf', 'D');
    }
}
