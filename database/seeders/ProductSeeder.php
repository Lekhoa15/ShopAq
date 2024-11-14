<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'Description for product 1',
            'price' => 100,
            'stock' => 50,
            'image_path' => 'images/products/product1.jpg',
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Description for product 2',
            'price' => 150,
            'stock' => 30,
            'image_path' => 'images/products/product2.jpg',
        ]);
    }
}
