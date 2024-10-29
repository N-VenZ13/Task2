<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<100;$i++){
            Product::create([
                'nama_minuman' => 'nama_minuman'.$i,
                'harga_minuman' => 'harga_minuman'.$i, 
                'jumlah' => $i+1*2,
                
            ]);
        }
    }
}
