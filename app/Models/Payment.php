<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'seller_id',
        'gross_amount',
        'ongkir',
        'service',
        'status',
        'resi',
        'checkout_link',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Perusahaan::class, 'seller_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(PaymentItem::class, 'payment_id', 'order_id');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, PaymentItem::class, 'payment_id', 'id', 'order_id', 'product_id');
    }
}
