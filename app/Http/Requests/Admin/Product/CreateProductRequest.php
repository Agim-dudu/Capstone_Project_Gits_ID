<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'type' => 'required|in:Anggur Meja (Table Grapes),Anggur Hitam (Black Grapes),Anggur Merah (Red Grapes),Anggur Putih (White Grapes),Anggur untuk Wine (Wine Grapes),Anggur Kismis (Raisin Grapes)',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
