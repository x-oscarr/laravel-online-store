<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends BaseResource
{
    public const ATTR_PARAMETERS = ['type'];
    public const SORT_PARAMETERS = ['relevance'];
    public const SEARCH_MODE_PARAMETERS = [];
    public const RELATION_PARAMETERS = ['file'];

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
