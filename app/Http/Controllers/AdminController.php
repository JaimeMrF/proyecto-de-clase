<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $totalProductos = Product::count();
        $totalCategorias = Category::count();
        $ultimosProductos = Product::latest()->take(5)->get();

        return view('admin.index', compact(
            'totalProductos',
            'totalCategorias',
            'ultimosProductos'
        ));
    }
}