<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        $product1 = new Product();
        $product1->name = "Telefono";
        $product1->description = "Este es un telefono";
        $product1->price = 1000;
        $product1->category_id = Category::inRandomOrder()->first()->id;
        $product1->save();
        
        $product2 = new Product();
        $product2->name = "Televisor";
        $product2->description = "Este es un televisor";
        $product2->price = 2000;
        $product2->category_id = Category::inRandomOrder()->first()->id;
        $product2->save();
        
        $product3 = new Product();
        $product3->name = "nevera";
        $product3->description = "Esta es una nevera";
        $product3->category_id = Category::inRandomOrder()->first()->id;
        $product3->price = 3000;
        $product3->save();
    }
}
