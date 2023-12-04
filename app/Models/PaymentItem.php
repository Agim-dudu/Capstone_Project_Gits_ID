<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    use HasFactory;
    
    protected $fillable = ['payment_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Perusahaan::class, 'seller_id', 'id');
    }

    // public function customer()
    // {
    //     return $this->belongsTo(User::class, 'customer_id', 'id');
    // }

    // public function seller()
    // {
    //     return $this->belongsTo(Perusahaan::class, 'seller_id', 'id');
    // }
}
