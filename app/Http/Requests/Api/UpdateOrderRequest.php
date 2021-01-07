<?php

namespace App\Http\Requests\Api;

use App\Models\Order;
use App\Models\OrderItem;
use App\Rules\InArrayKeyRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'integer',
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
            'items' => 'array',
            'items.*' => [new InArrayKeyRule((new OrderItem)->fillable)]
        ];
    }
}
