<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WishlistController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->response([
            'data' => Cart::instance('wishlist')->content(),
        ], Response::HTTP_OK);
    }

    public function updateItem(Request $request): JsonResponse
    {
        $wishlist = Cart::instance('wishlist');
        $product = Product::find($request->get('itemId'));
        if(!$product) {
            return $this->error('product_not_found', ['id' => $product->id]);
        }

        $existsItems = $wishlist->search(function ($wishItem) use($product) {
            return $wishItem->id === $product->id;
        });

        if($existsItems->isEmpty()) {
            $wishlist->add($product->id, $product->name)->associate(Product::class);
        } else {
            $wishlist->remove($existsItems->first()->rowId);
        }

        return $this->response([
            'status' => $existsItems->isEmpty(),
        ], Response::HTTP_OK);
    }

    public function removeItem(Request $request): JsonResponse
    {
        Cart::instance('wishlist')->remove($request->get('rowId'));
        return $this->response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(Request $request): JsonResponse
    {
        return $this->response(null, Response::HTTP_NO_CONTENT);
    }
}
