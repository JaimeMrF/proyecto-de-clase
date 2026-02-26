<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as AuthUser;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
    
        User::factory(1000)->create();
       Category::factory(10000)->create();
       Product::factory(100000)->create();
       CartItem::factory(100000)->create();
        
    }
}
