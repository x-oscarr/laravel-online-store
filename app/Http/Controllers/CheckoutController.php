<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Cart::count() < 1) {
            return redirect()->back();
        }
        return view('checkout.index', [
            'cartItems' => Cart::content(),
            'total' => Cart::total()
        ]);
    }

    public function createOrder(Request $request)
    {
        if(Cart::count() < 1) {
            return redirect()->back();
        }
        $orderData = $request->all();
        $client = new Client();
        $res = $client->request('POST', config('shop.new_post.url'), [
            'headers' => config('shop.new_post.headers'),
            'body' => json_encode([
                "apiKey" => config('shop.new_post.apikey'),
                "modelName" => "Address",
                "calledMethod" => "getSettlements",
                "methodProperties" => [
                    "Ref" => $orderData['city'],
                ],
            ])
        ]);
        $result = json_decode($res->getBody()->getContents());
        $orderData['city'] = $result->data[0]->Description;
        $user = User::getOrCreate(
            $orderData['telephone'],
            $orderData['first-name'].' '.$orderData['second-name'],
            $orderData['email']
        );

        $order = new Order();
        $order->user_id = $user->id;
        $order->city = $orderData['city'];
        $order->warehouse = $orderData['warehouse'];
        if($orderData['post-delivery-street'] && $orderData['post-delivery-house']) {
            $order->address =
                $orderData['post-delivery-street'].', буд. '.
                $orderData['post-delivery-house'];
            if($orderData['post-delivery-flat']) {
                $order->address .= ', кв. '.$orderData['post-delivery-flat'];
            }
        }
        $order->comment = $orderData['comment'];
        $order->ip = $request->ip();
        $order->user_agent = $request->header('User-Agent');
        $order->delivery_type = $orderData['delivery-type'];
        $order->pay_type = $orderData['pay-type'];
        $order->status = Order::STATUS_NEW;
        $order->save();
        $cart = Cart::content();
        foreach($cart as $item) {
            $order->setItem($item->model, $item->qty);
        }
        Cart::destroy();
        return view('order-success', ['order' => $order]);
    }

    public function oneClick(Request $request)
    {
        $name = $request->get('order-name');
        $phone = $request->get('order-phone');
        $email = $request->get('order-email');
        $product = Product::find($request->get('product'));
        $qty = $request->get('quantity') ?? 1;
        if(!$product) {
            return response('ui.error_order_froduct_not_find', 500);
        }
        $user = User::getOrCreate($phone, $name);
        $user->email = $email;
        $user->save();

        $order = new Order();
        $order->user_id = $user->id;
        $order->ip = $request->ip();
        $order->user_agent = $request->header('User-Agent');
        $order->comment = $request->get('order-comment');
        $order->status = Order::STATUS_NEW;
        $order->save();
        $order->setItem($product, $qty);

        return $this->success($order);
    }
}
