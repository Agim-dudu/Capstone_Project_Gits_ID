<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Jobs\SendContactFormEmail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::all();
        $products = Product::all();
        $users = User::all();

        return view('contact', compact('products', 'users','perusahaans'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Dispatch pekerjaan untuk mengirim email
        SendContactFormEmail::dispatch($data)->onQueue('default');
        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
