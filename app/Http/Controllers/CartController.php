<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Obtener carrito de la sesión
    private function getCart()
    {
        return session()->get('cart', []);
    }

    // Guardar carrito en sesión
    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    public function index()
    {
        $cart     = $this->getCart();
        $products = [];
        $total    = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $subtotal   = $product->price * $item['quantity'];
                $total     += $subtotal;
                $products[] = [
                    'product'  => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart.index', compact('products', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart    = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->get('quantity', 1);
        } else {
            $cart[$id] = ['quantity' => $request->get('quantity', 1)];
        }

        $this->saveCart($cart);

        return redirect()->back()->with('cart_success', "'{$product->name}' agregado al carrito.");
    }

    public function update(Request $request, $id)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $qty = (int) $request->get('quantity', 1);
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $qty;
            }
        }

        $this->saveCart($cart);
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        unset($cart[$id]);
        $this->saveCart($cart);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}