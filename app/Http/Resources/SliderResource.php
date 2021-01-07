<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends BaseResource
{
    const ATTR_PARAMETERS = ['type'];
    const SORT_PARAMETERS = ['relevance'];
    const SEARCH_MODE_PARAMETERS = [];
    const RELATION_PARAMETERS = ['file'];

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
