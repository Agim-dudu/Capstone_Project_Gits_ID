<?php

namespace App\Models;

use App\Models\Wishlist;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'first_name',
        'avatar',
        'last_name',
        'phone', // Change to match the seeder attribute name
        'province_id',
        'province',
        'city_id', // Change to match the seeder attribute name
        'city', // Change to match the seeder attribute name
        'address', // Change to match the seeder attribute name
        'postal_code', 
        'password',
        'provider',
        'provider_id',
        'provider_token',
        'role',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the addresses associated with the user.
     */


    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'customer_id', 'id');
    }

     public function paymentItems()
     {
         return $this->hasManyThrough(
             PaymentItem::class,    // Model Tujuan (PaymentItem)
             Payment::class,        // Model Tengah (Payment)
             'customer_id',         // Kunci Asing pada Model Awal (User)
             'id',                  // Kunci Primer pada Model Tengah (Payment)
             'id',                  // Kunci Asing pada Model Tujuan (PaymentItem)
             'payment_id'           // Kunci Primer pada Model Tujuan (PaymentItem)
         );
     }

     public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
     
}
