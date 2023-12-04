<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::all();
        $products = Product::all();
        return view('shop', compact('products','perusahaans'));
    }

    public function show($productId)
    {

        $perusahaans = Perusahaan::all();
        $product = Product::findOrFail($productId);

        return view('product-single', compact('product','perusahaans'));
    }
}
