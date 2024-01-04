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
        Product::create([
            'name' => 'Product One',
            'price' => 150
        ]);

        Product::create([
            'name' => 'Product Two',
            'price' => 200
        ]);
        Product::create([
            'name' => 'Product Three',
            'price' => 250
        ]);
        Product::create([
            'name' => 'Product Four',
            'price' => 300
        ]);
        Product::create([
            'name' => 'Product FIve',
            'price' => 350
        ]);
        Product::create([
            'name' => 'Product Six',
            'price' => 400
        ]);
        Product::create([
            'name' => 'Product Seven',
            'price' => 450
        ]);
        Product::create([
            'name' => 'Product Eight',
            'price' => 500
        ]);
        Product::create([
            'name' => 'Product Nine',
            'price' => 550
        ]);
        Product::create([
            'name' => 'Product Ten',
            'price' => 600
        ]);
    }
}
