<?php

namespace App\Http\Requests\Api;

use App\Models\Order;
use App\Models\OrderItem;
use App\Rules\InArrayKeyRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
{

    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'status' => [Rule::in(array_keys(Order::STATUSES))],
            'city' => 'nullable|min:4|max:255',
            'warehouse' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'comment' => 'nullable',
            'delivery_type' => 'nullable',
            'pay_type' => 'nullable',
            'ip' => 'nullable|ip',
            'user_agent' => 'nullable',
            'manager_id' => 'nullable|integer',
            'items' => 'required|array',
            'items.*' => [new InArrayKeyRule((new OrderItem)->fillable)]
        ];
    }
}
