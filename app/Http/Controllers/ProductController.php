<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $categoryList = Category::all();
        return view('product.create',[
            'categoryList' => $categoryList
    ]);
    }

    public function store(Request $request){

       
        $new_product = new Product();
        $new_product->name = $request->get('nombre');
        $new_product->description = $request->get('descripcion');
        $new_product->price = $request->get('precio');
        $new_product->category_id = $request->get('categoria');

        if ($request->hasFile('imagen')){
            $ruta = $request->file('imagen')->store('images','public');
            $new_product->image = $ruta;
        }

        $new_product->save();

            return redirect()->route('product.index');
    }

    public function show($producto)
    {
        return view('product.show', compact('producto'));
    }
}