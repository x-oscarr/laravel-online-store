<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends BaseResource
{
    public const ATTR_PARAMETERS = ['name', 'email', 'phone_number', 'role', 'city', 'address'];
    public const SORT_PARAMETERS = ['relevance', '-popularity'];
    public const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS'];
    public const RELATION_PARAMETERS = ['items',];

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
