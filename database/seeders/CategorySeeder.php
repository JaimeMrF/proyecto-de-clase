<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $category1 = new Category();
        $category1->name = "Electrodomesticos";
        $category1->description  = "Este es la descripcion del electrodomestico";
        $category1->save();

        $category2 = new Category();
        $category2->name = "Tecnologia";
        $category2->description  = "Este es la descripcion de Tecnologia";

        $category2->save();

    }
}
