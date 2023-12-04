<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {

        $perusahaans = Perusahaan::all();
        $user = Auth::user();

        $orders = $user->payments;

        return view('order.my-order', compact('orders', 'perusahaans'));
    }

    public function showOrderDetail($orderId)
    {

        $order = Payment::where('order_id', $orderId)->firstOrFail();
        $perusahaans = Perusahaan::all();

        return view('order.detail-order', compact('order', 'perusahaans'));
    }

    public function deleteOrder($orderId)
    {
        $order = Payment::where('order_id', $orderId)->firstOrFail();

        if ($order->customer_id !== Auth::id()) {
            return redirect()->route('my-order')->with('error', 'Anda tidak memiliki izin untuk menghapus pesanan ini.');
        }

        $order->delete();

        return redirect()->route('my-order')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function ViewInvoicePDF($orderId)
    {
        $order = Payment::where('order_id', $orderId)->firstOrFail();
        $perusahaans = Perusahaan::all();

        return view('order.invoice', compact('order', 'perusahaans'));
        
    }

    public function DownloadInvoicePDF($orderId)
    {
        $order = Payment::where('order_id', $orderId)->firstOrFail();
        $perusahaans = Perusahaan::all();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf -> WriteHTML(view('order.invoice', compact('order', 'perusahaans')));
        $mpdf->Output('invoice.pdf','D');
        
    }
}
