<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Perusahaan;
use App\Models\PaymentItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    public function index()
    {

        // Ambil data produk
        $products = Product::all();
        $perusahaans = Perusahaan::all();
        $users = User::all();

        // Menggunakan compact untuk menyusun variabel-variabel ke dalam array
        return view('checkout', compact('products', 'perusahaans', 'users'));
    }



    public function create(Request $request)
    {

        // Mendapatkan data perusahaan dan pengguna
        $perusahaan = Perusahaan::first();
        $user = Auth::user();

        // Memastikan perusahaan dan pengguna ditemukan
        if (!$perusahaan || !$user) {
            return response()->json(['message' => 'User or Perusahaan not found'], 404);
        }

        // Periksa status pembayaran sebelum membuat pembayaran baru
        $lastPayment = Payment::where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastPayment && $lastPayment->status == 'Pending') {
            return redirect()->route('my-order')->with('warning', 'Anda memiliki pembayaran yang sedang diproses. Harap tunggu hingga selesai.');
        }

        // Validasi formulir
        $request->validate([
            'ongkir' => 'required|numeric|min:0',
            'gross_amount' => 'required|numeric|min:0',
            'jasa_pengirim' => 'required|string',
        ]);

        // Mendapatkan nilai formulir
        $ongkir = $request->input('ongkir');
        $grossAmount = $request->input('gross_amount');
        $service = $request->input('jasa_pengirim');

        // Membuat array parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => Str::uuid(),
                'gross_amount' => (float) $grossAmount,
                'service' => $service,
            ],
            'item_details' => array_merge(
                array_map(function ($cartItem) {
                    return [
                        'id' => $cartItem['product_id'],
                        'price' => (float) $cartItem['price'],
                        'quantity' => (float) $cartItem['quantity'],
                        'name' => $cartItem['name'],
                    ];
                }, session('cart', [])),
                [
                    [
                        'price' => (float) $ongkir,
                        'quantity' => (float) 1,
                        'name' => "Ongkos Kirim",
                    ],
                ]
            ),
            'customer_details' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'billing_address' => [
                    'address' => $user->address,
                    'city' => $user->city,
                    'postal_code' => $user->postal_code,
                ],
                'shipping_address' => [
                    'id' => $perusahaan->id,
                    'first_name' => "Anggur",
                    'last_name' => "Kita",
                    'address' => $perusahaan->address,
                    'city' => $perusahaan->city,
                    'postal_code' => $perusahaan->postal_code,
                    'phone' => $perusahaan->phone,
                ],
            ],
            'callbacks' => [
                'finish' => "http://127.0.0.1:8000/api/webhooks/midtrans",
            ]
        ];

        // Membuat otorisasi untuk Midtrans
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        // Melakukan pembayaran dengan Midtrans
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        // dd(session('cart', []));

        // Memeriksa apakah properti redirect_url ada pada objek $response
        $redirectUrl = data_get($response, 'redirect_url');

        // Menyimpan informasi pembayaran ke dalam database
        $payment = new Payment;
        $payment->order_id = $params['transaction_details']['order_id'];
        $payment->customer_id = data_get($params, 'customer_details.id');
        $payment->seller_id = data_get($params, 'customer_details.shipping_address.id');
        $payment->gross_amount = $grossAmount;
        $payment->ongkir = $ongkir;
        $payment->service = $service;
        $payment->status = 'Pending';
        $payment->checkout_link = $redirectUrl;
        $payment->save();

        // Menggunakan ID dari objek Payment yang baru saja dibuat
        $paymentId = $payment->order_id;

        foreach (session('cart', []) as $cartItem) {
            $paymentItem = new PaymentItem;
            $paymentItem->payment_id = $paymentId;
            $paymentItem->product_id = $cartItem['product_id'];
            $paymentItem->quantity = $cartItem['quantity'];
            $paymentItem->price = $cartItem['price'];
            $paymentItem->save();
        }

        // Setelah foreach loop selesai, hapus isi session 'cart'
        Session::forget('cart');
        Session::forget('ongkir');

        // Melakukan pengalihan ke halaman pembayaran Midtrans
        return redirect()->away($response->redirect_url);
    }

    public function webhook(Request $request)
    {
        // Membuat otorisasi untuk Midtrans
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        // Melakukan pembayaran dengan Midtrans
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/{$request->order_id}/status");

        $response = json_decode($response->body());

        // cek db
        $payment = Payment::where('order_id', $response->order_id)->first();
        // dd($response);

        // || $payment->status === 'authorize' || $payment->status === 'deny'  || $payment->status === 'pending' || $payment->status === 'refund' || $payment->status === 'partial_refund' || $payment->status === 'chargeback' $payment->status === 'partial_chargeback' || $payment->status === 'expire' || $payment->status === 'failure'

        if ($payment->status === 'settlement' || $payment->status === 'capture'){
            return response()->json(["status_code" => "200", "message" => "Pembayaran sudah diproses"]);
        }

        if ($response->transaction_status === 'capture') {
            $payment->status = 'capture';
        } else if($response->transaction_status === 'settlement'){
            $payment->status = 'settlement';
        }else if($response->transaction_status === 'pending'){
            $payment->status = 'pending';
        }

        // $paymentStatusMapping = [
        //     "capture" => "Berhasil",
        //     "settlement" => "Settlement",
        //     "deny" => "Ditolak",
        //     "failure" => "",
        //     "authorize" => "Authorize",
        //     "pending" => "Menunggu Pembayaran",
        //     "refund" => "Refund",
        //     "partial_refund" => "Pengembalian Sebagian",
        //     "chargeback" => "Chargeback",
        //     "partial_chargeback" => "Chargeback Sebagian",
        //     "expire" => "Kadaluarsa",
        // ];

        $payment->save();

        return redirect()->route('my-order')->with('success', 'pembayaran berhasil kami sedang memproses pesanan anda.');
    }
}
