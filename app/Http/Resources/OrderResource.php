<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends BaseResource
{
    const ATTR_PARAMETERS = ['user_id', 'status', 'delivery_type', 'pay_type', 'ip', 'manager_id'];
    const SORT_PARAMETERS = ['novelty', '-novelty'];
    const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS'];
    const RELATION_PARAMETERS = ['items',];

    public function toArray($request)
    {
        $attributes = $this->resource->toArray();
        if(!$request->get('items') || $request->get('items') == true) {
            $attributes['items'] = $this->resource->items->toArray();
        }

        return $attributes;
    }
}
