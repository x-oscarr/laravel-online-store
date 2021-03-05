<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends BaseResource
{
    public const ATTR_PARAMETERS = ['type', 'price', 'is_enabled', 'is_available', 'is_new'];
    public const SORT_PARAMETERS = ['relevance', 'novelty', '-novelty', 'price', '-price', '-popularity'];
    public const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS'];
    public const RELATION_PARAMETERS = ['seo',];

    public function toArray($request): array
    {
        $attributes = $this->resource->attributesToArray();
        if($request->get('seo')) {
            $attributes['seo'] = $this->resource->seo->seoAttributesToArray();
        }

        return $attributes;
    }
}
