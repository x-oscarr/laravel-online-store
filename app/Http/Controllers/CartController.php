<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function page(Request $request)
    {
        $product = Product::find($request->get('itemId'));
        if($product && $product->is_available) {
            Cart::add($product->id, $product->trans->name, $request->get('quantity') ?? 1, $product->price)
                ->associate('App\Product');
        }
        $cartItems = Cart::content();
        $total = Cart::total(false);
        return view('cart.index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function add(Request $request): Response
    {
        if(!$request->get('itemId')) {
            return response(['errText' => 'Item id not found'], 500);
        }

        $product = Product::find($request->get('itemId'));
        if(!$product) {
            return response(['errText' => 'Item not found'], 500);
        }

        $existsItems = Cart::search(function ($cartItem) use($request) {
            return $cartItem->id == $request->get('item');
        });

        if($existsItems->isEmpty()) {
            Cart::add($product->id, $product->trans->name, $request->get('quantity') ?? 1, $product->price)
                ->associate('App\Product');
        } else {
            Cart::remove($existsItems->first()->rowId);
        }

        return response([
            'cartCount' => Cart::count(),
            'status' => $existsItems->isEmpty()
        ], 200);
    }

    public function content(Request $request)
    {
        $items = Cart::content();
        return response(['items' => $items, 'total' => Cart::total(),], 200);
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
