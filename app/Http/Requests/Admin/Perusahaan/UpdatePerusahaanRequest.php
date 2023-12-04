<?php

namespace App\Http\Requests\Admin\Perusahaan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerusahaanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_perusahaan' => 'required|string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'province_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'url' => 'nullable|string',
            'jumlah_karyawan' => 'required|integer',
            'tahun_pendirian' => 'nullable|integer',
        ];
    }
}
