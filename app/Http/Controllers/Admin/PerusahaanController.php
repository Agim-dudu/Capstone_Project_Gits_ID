<?php

namespace App\Http\Controllers\Admin;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerusahaanExport;
use App\Http\Requests\Admin\Perusahaan\UpdatePerusahaanRequest;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::all();

        return view('admin.perusahaan.index', compact('perusahaans'));
    }

    public function edit($id)
    {
        $responseProvince = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/province');
        // dd($responseProvince->json());

        $responseCity = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/city');
        // dd($response->json());

        $province = $responseProvince['rajaongkir']['results'];
        $cities = $responseCity['rajaongkir']['results'];
        $perusahaan = Perusahaan::findOrFail($id);

        return view('admin.perusahaan.edit', compact('perusahaan', 'province', 'cities'));
    }

    public function update(UpdatePerusahaanRequest $request, $id)
    {
        $perusahaan = Perusahaan::find($id);

        if (!$perusahaan) {
            return redirect()->back()->with('error', 'Perusahaan tidak ditemukan.');
        }

        if ($perusahaan->logo) {
            Storage::delete('public/logo/' . $perusahaan->logo);
        }

        if ($request->hasFile('logo')) {
            $namaLogo = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            Storage::putFileAs('public/logo', $request->file('logo'), $namaLogo);

            $perusahaan->logo = $namaLogo;
        }

        $perusahaan->nama_perusahaan = $request->input('nama_perusahaan');
        $perusahaan->province_id = $request->input('province_id');
        $perusahaan->city_id = $request->input('city_id');
        $perusahaan->province = $request->input('province');
        $perusahaan->city = $request->input('city');
        $perusahaan->postal_code = $request->input('postal_code');
        $perusahaan->address = $request->input('address');
        $perusahaan->email = $request->input('email');
        $perusahaan->phone = $request->input('phone');
        $perusahaan->url = $request->input('url');
        $perusahaan->jumlah_karyawan = $request->input('jumlah_karyawan');
        $perusahaan->tahun_pendirian = $request->input('tahun_pendirian');

        $perusahaan->save();

        return redirect()->route('role.admin.perusahaan')->with('success', 'Perusahaan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $perusahaan = Perusahaan::find($id);

        if (!$perusahaan) {
            return redirect()->back()->with('error', 'Perusahaan tidak ditemukan.');
        }

        // Hapus logo jika ada
        if ($perusahaan->logo) {
            Storage::delete('public/logo/' . $perusahaan->logo);
        }

        // Hapus perusahaan
        $perusahaan->delete();

        return redirect()->route('role.admin.perusahaan')->with('success', 'Perusahaan berhasil dihapus.');
    }

    public function exportPerusahaans()
    {
        $perusahaans = Perusahaan::all();
        return Excel::download(new PerusahaanExport($perusahaans), 'perusahaans.xlsx');
    }


    public function DownloadPerusahaanPDF()
    {
        $perusahaans = Perusahaan::all();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.perusahaan.pdf', compact('perusahaans'))->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('perusahaan.pdf','D');
    }
}
