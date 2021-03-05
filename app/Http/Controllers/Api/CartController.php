<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CartController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->response([
            'data' => Cart::content(),
            'total' => [
                'amount' => Cart::total(),
                'count' => Cart::count()
            ],
        ], Response::HTTP_OK);
    }

    public function updateItem(Request $request): JsonResponse
    {
        $product = Product::find($request->get('itemId'));
        if(!$product) {
            return $this->error('product_not_found', ['id' => $product->id]);
        }

        $existsItems = Cart::search(function ($cartItem) use($product) {
            return $cartItem->id === $product->id;
        });

        if($existsItems->isEmpty()) {
            Cart::add($product->id, $product->name, $request->get('quantity') ?? 1, $product->price)
                ->associate(Product::class);
        } else {
            Cart::remove($existsItems->first()->rowId);
        }

        return $this->response([
            'status' => $existsItems->isEmpty(),
            'total' => [
                'amount' => Cart::total(),
                'count' => Cart::count()
            ],
        ], Response::HTTP_OK);
    }

    public function removeItem(Request $request): JsonResponse
    {
        Cart::remove($request->get('rowId'));
        return $this->response([
            'total' => [
                'amount' => Cart::total(),
                'count' => Cart::count()
            ],
        ], Response::HTTP_OK);
    }

    public function updateQuantity(Request $request): JsonResponse
    {
        Cart::update($request->get('rowId'), $request->get('quantity'));
        return $this->response([
            'total' => [
                'amount' => Cart::total(),
                'count' => Cart::count()
            ],
        ], Response::HTTP_OK);
    }

    public function destroy(Request $request): JsonResponse
    {
        Cart::instance('wishlist')->erase('username');
        return $this->response(null, Response::HTTP_NO_CONTENT);
    }
}
