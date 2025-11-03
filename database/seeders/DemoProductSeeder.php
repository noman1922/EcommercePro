<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class DemoProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'title' => 'iPhone 15 Pro',
                'description' => 'Latest Apple smartphone with A17 Pro chip',
                'image' => 'https://via.placeholder.com/300x300.png?text=iPhone+15',
                'catagory' => 'Smartphones',           // ← YOUR spelling
                'quantity' => 50,
                'price' => 999.99,
                'discount_price' => 899.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MacBook Air M2',
                'description' => 'Ultra-thin laptop with M2 chip',
                'image' => 'https://via.placeholder.com/300x300.png?text=MacBook',
                'catagory' => 'Laptops',               // ← YOUR spelling
                'quantity' => 30,
                'price' => 1199.99,
                'discount_price' => 1099.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'AirPods Pro 2',
                'description' => 'Wireless earbuds with ANC',
                'image' => 'https://via.placeholder.com/300x300.png?text=AirPods',
                'catagory' => 'Accessories',           // ← YOUR spelling
                'quantity' => 100,
                'price' => 249.99,
                'discount_price' => 199.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}