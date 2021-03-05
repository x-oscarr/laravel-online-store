<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends BaseResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
