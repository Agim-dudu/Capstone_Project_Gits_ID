<?php

namespace App\Exports;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PerusahaanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Perusahaan::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Perusahaan',
            'Logo',
            'Province ID',
            'Province',
            'City ID',
            'City',
            'Postal Code',
            'Address',
            'Email',
            'Phone',
            'URL',
            'Jumlah Karyawan',
            'Tahun Pendirian',
            'Created At',
            'Updated At',
        ];
    }
}
