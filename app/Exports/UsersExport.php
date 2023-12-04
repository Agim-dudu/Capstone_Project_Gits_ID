<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'First Name',
            'Last Name',
            'Province ID',
            'Province',
            'City ID',
            'City',
            'Postal Code',
            'Address',
            'Phone',
            'Email Verified At',
            'Password',
            'Avatar',
            'Provider',
            'Provider ID',
            'Provider Token',
            'Role',
            'Remember Token',
            'Created At',
            'Updated At',
        ];
    }
}
