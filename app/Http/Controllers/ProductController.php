<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $ProductList = Product::all();
        return view('product.index', ['misProductos' => $ProductList]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function show($producto)
    {
        return view('product.show', compact('producto'));
    }
}