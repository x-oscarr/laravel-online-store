<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::find($request->get('itemId'));
        if($product && $product->is_available) {
            Cart::add($product->id, $product->name, $request->get('quantity') ?? 1, $product->price)
                ->associate(Product::class);
        }

        return view('cart.index', [
            'cartItems' => Cart::content(),
            'total' => Cart::total(false)
        ]);
    }

    public function add(Request $request): Response
    {

    }

    public function quantity(Request $request)
    {
        Cart::update($request->get('rowId'), $request->get('quantity'));
        return response(['total' => Cart::total(false)], 200);
    }

    public function remove(Request $request)
    {
        Cart::remove($request->get('rowId'));
        return response(['total' => Cart::total(false)], 200);
    }
}
