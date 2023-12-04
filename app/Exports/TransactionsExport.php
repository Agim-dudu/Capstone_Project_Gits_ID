<?php

namespace App\Exports;

use App\Models\Payment;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function collection()
    {
        $exportData = collect();

        foreach ($this->payments as $payment) {
            foreach ($payment->items as $item) {
                $exportData->push([
                    'Nama Customer' => $payment->customer->name,
                    'Product' => $item->product->name,
                    'Jumlah/Kg' => $item->quantity,
                    'Harga' => $item->price,
                    'Ongkir' => $payment->ongkir,
                    'Service' => $payment->service,
                    'Total Bayar' => $payment->gross_amount,
                    'Resi' => $payment->resi,
                    'Status Pembayaran' => $payment->status,
                ]);
            }
        }

        return $exportData;
    }

    public function headings(): array
    {
        return [
            'Nama Customer',
            'Product',
            'Jumlah/Kg',
            'Harga',
            'Ongkir',
            'Service',
            'Total Bayar',
            'Resi',
            'Status Pembayaran',
            // Tambahkan kolom lain sesuai kebutuhan
        ];
    }
}
