<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'role' => 'required|in:0,1',
            'password' => 'nullable|min:8|confirmed',
            'province_id' => 'required',
            'city_id' => 'required',
            'postal_code' => 'max:255',
            'phone' => 'max:255',
            'address' => 'max:255',
        ];
    }
}
