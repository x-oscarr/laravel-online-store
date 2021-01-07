<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class OrderController extends ApiController
{

    public function index(Request $request): AnonymousResourceCollection
    {
        $accessAbility = 'read';
        $abilities = OrderResource::apiScopes($accessAbility);
        $this->checkAccess($abilities);

        $orderQuery = Order::query();
        OrderResource::abilityAccess($accessAbility) ? $orderQuery->where('user_id', Auth::user()->id) : null;
        $orderQuery = $this->queryWithSearch($orderQuery, $request, OrderResource::SEARCH_MODE_PARAMETERS);
        $orderQuery = $this->queryWithParams($orderQuery, $request, OrderResource::ATTR_PARAMETERS);
        $orderQuery = $this->queryWithSort($orderQuery, $request, OrderResource::SORT_PARAMETERS);
        $orderQuery = $this->queryWithLimits($orderQuery, $request);
        return OrderResource::collection($orderQuery->get());
    }

    public function store(CreateOrderRequest $request): OrderResource
    {
        $abilities = OrderResource::apiScopes('create');
        $this->checkAccess($abilities);
        $order = Order::create($request->all());
        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        $accessAbility = 'read';
        $abilities = OrderResource::apiScopes($accessAbility);
        $this->checkAccess($abilities);

        if(OrderResource::abilityAccess($accessAbility) && $order->user_id != Auth::user()->id) {
            return $this->error('access_error', [
               'scopes' => OrderResource::apiScopes($accessAbility, true)[0]
            ]);
        }

        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $accessAbility = 'update';
        $abilities = OrderResource::apiScopes($accessAbility);
        $this->checkAccess($abilities);

        if(OrderResource::abilityAccess($accessAbility) && $order->user_id != Auth::user()->id) {
            return $this->error('access_error', [
                'scopes' => OrderResource::apiScopes($accessAbility, true)[0]
            ]);
        }

        $order->update($request->all());
        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $accessAbility = 'delete';
        $abilities = OrderResource::apiScopes('delete');
        $this->checkAccess($abilities);

        if(OrderResource::abilityAccess($accessAbility) && $order->user_id != Auth::user()->id) {
            return $this->error('access_error', [
                'scopes' => OrderResource::apiScopes($accessAbility, true)[0]
            ]);
        }

        $order->delete();
        $this->response([null, Response::HTTP_OK]);
    }


}
