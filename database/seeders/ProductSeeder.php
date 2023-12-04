<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public function run()
    {

        // Hapus data lama jika ada
        Product::query()->delete();

        $products1 = new Product([
            'name' => 'Concord',
            'description' => ' adalah anggur yang memiliki rasa yang manis dan asam. Anggur Concord adalah anggur asli Amerika Serikat dan merupakan bahan umum untuk selai anggur, jus anggur, dan minuman anggur.',
            'price' => 135000,
            'stock' => 30,
            'weight' => 1000,
            'type' => 'Anggur Hitam (Black Grapes)',
            'image' => 'concord.png',
        ]);
        $products1->save();

        $products2 = new Product([
            'name' => 'Black Corinth',
            'description' => 'adalah anggur hitam yang memiliki rasa yang manis dan asam. Anggur Black Corinth adalah anggur kecil yang sering digunakan untuk membuat selai dan manisan.',
            'price' => 120000,
            'stock' => 20,
            'weight' => 1000,
            'type' => 'Anggur Hitam (Black Grapes)',
            'image' => 'black_corinth.png',
        ]);
        $products2->save();

        $products3 = new Product([
            'name' => 'Green Seedless',
            'description' => 'adalah anggur hijau yang tidak berbiji. Buah anggurnya berwarna hijau dengan rasa yang manis.',
            'price' => 108000,
            'stock' => 20,
            'weight' => 1000,
            'type' => 'Anggur Hijau (Green Grapes)',
            'image' => 'green_seedless.png',
        ]);
        $products3->save();
        
        $products4 = new Product([
            'name' => 'Thompson Seedless',
            'description' => 'adalah anggur hijau yang tidak berbiji. Buah anggurnya berwarna hijau dengan rasa yang manis.',
            'price' => 108000,
            'stock' => 25,
            'weight' => 1000,
            'type' => 'Anggur Hijau (Green Grapes)',
            'image' => 'thompson_seedless.png',
        ]);
        $products4->save();
        
        $products5 = new Product([
            'name' => 'Pinot Gris',
            'description' => 'adalah anggur putih yang memiliki rasa yang manis dan aroma yang kuat. Buah anggurnya berwarna kuning keemasan dengan rasa yang manis.',
            'price' => 110000,
            'stock' => 15,
            'weight' => 1000,
            'type' => 'Anggur Putih (White Grapes)',
            'image' => 'pinot_gris.png',
        ]);
        $products5->save();
        
        $products6 = new Product([
            'name' => 'Riesling',
            'description' => 'adalah anggur putih yang memiliki rasa yang manis dan aroma yang kuat. Buah anggurnya berwarna kuning kehijauan dengan rasa yang manis.',
            'price' => 120000,
            'stock' => 10,
            'weight' => 1000,
            'type' => 'Anggur Putih (White Grapes)',
            'image' => 'riesling.png',
        ]);
        $products6->save();
        
        $products7 = new Product([
            'name' => 'Merlot',
            'description' => 'adalah anggur merah yang memiliki rasa yang lembut dan halus. Buah anggurnya berwarna merah dengan rasa yang manis.',
            'price' => 200000,
            'stock' => 30,
            'weight' => 1000,
            'type' => 'Anggur Merah (Red Grapes)',
            'image' => 'merlot.png',
        ]);
        $products7->save();
        
        $products8 = new Product([
            'name' => 'Cabernet Sauvignon',
            'description' => 'adalah anggur merah yang paling populer di dunia. Buah anggurnya berwarna merah tua dengan rasa yang kuat dan kompleks.',
            'price' => 204000,
            'stock' => 10,
            'weight' => 1000,
            'type' => 'Anggur Merah (Red Grapes)',
            'image' => 'cabernet_sauvignon.png',
        ]);
        $products8->save();
    }
}
