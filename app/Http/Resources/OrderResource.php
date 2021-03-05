<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends BaseResource
{
    public const ATTR_PARAMETERS = ['user_id', 'status', 'delivery_type', 'pay_type', 'ip', 'manager_id'];
    public const SORT_PARAMETERS = ['novelty', '-novelty'];
    public const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS'];
    public const RELATION_PARAMETERS = ['items',];

    public function toArray($request): array
    {
        $attributes = $this->resource->toArray();
        if(!$request->get('items') || $request->get('items') === true) {
            $attributes['items'] = $this->resource->items->toArray();
        }

        return $attributes;
    }
}
