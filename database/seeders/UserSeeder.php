<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Hapus data lama jika ada
        User::query()->delete();

        $user1 = new User([
            'name' => 'agim',
            'email' => 'agimduduu@gmail.com',
            'password' => Hash::make('password123'),
            'avatar'=>'avatar.png',
            'first_name'=>'agim',
            'last_name'=>'dudu',
            'phone'=>'+6281258624198', 
            'province_id'=>'13',
            'province'=>'Kalimantan Selatan',
            'city_id'=>'36', 
            'city'=>'Banjarmasin', 
            'address'=>'jalan ke surga', 
            'postal_code'=> '70117', 
            'role' => 1,
            'email_verified_at' => now(),
        ]);
        $user1->save();
    }
}
