<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends BaseResource
{
    const ATTR_PARAMETERS = ['name', 'email', 'phone_number', 'role', 'city', 'address'];
    const SORT_PARAMETERS = ['relevance', '-popularity'];
    const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS'];
    const RELATION_PARAMETERS = ['items',];

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
