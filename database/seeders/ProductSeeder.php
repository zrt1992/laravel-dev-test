<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'Product 1', 'type'=> 'B2B','price' => 50,'currency' => 'usd'],
            ['name'=>'Product 2', 'type'=> 'B2C','price' => 30,'currency' => 'usd'],
        ];
        Product::insert($data);
    }
}
