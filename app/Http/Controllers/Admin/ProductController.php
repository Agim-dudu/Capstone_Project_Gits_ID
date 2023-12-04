<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;

class ProductController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('type', 'like', "%$query%")
            ->get();

        return view('admin.product.index', compact('products'));
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(CreateProductRequest $request)
    {

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            // Simpan file gambar ke storage
            $request->image->storeAs('public/product', $imageName);
        } else {
            // Jika tidak ada file gambar yang diupload, atur nama gambar menjadi null
            $imageName = null;
        }

        $product = new Product([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'weight' => 1000,
            'type' => $request->get('type'),
            'image' => $imageName,
        ]);

        $product->save();

        return redirect()->route('role.admin.product')->with('success', 'Product berhasil di tambahkan');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {

        $product = Product::find($id);

        if ($product->image) {
            Storage::delete('public/product/' . $product->image);
        }

        if ($request->hasFile('image')) {
            $namaImage = time() . '.' . $request->file('image')->getClientOriginalExtension();
            Storage::putFileAs('public/product', $request->file('image'), $namaImage);

            $product->image = $namaImage;
        }

        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->stock = $request->get('stock');
        $product->weight = $request->get('weight');
        $product->type = $request->get('type');


        $product->save();

        return redirect()->route('role.admin.product')->with('success', 'Product berhasil di update');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Perusahaan tidak ditemukan.');
        }

        // Hapus logo jika ada
        if ($product->image) {
            Storage::delete('public/product/' . $product->image);
        }

        $product->delete();

        return redirect()->route('role.admin.product')->with('success', 'Product has been deleted');
    }

    public function exportProduct()
    {
        $users = Product::all();
        return Excel::download(new ProductsExport($users), 'products.xlsx');
    }

    public function DownloadProductPDF()
    {
        $products = Product::all();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.product.pdf', compact('products'))->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('products.pdf','D');
    }
}
