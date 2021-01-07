<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends BaseResource
{
    const ATTR_PARAMETERS = ['type', 'price', 'is_enabled', 'is_available', 'is_new'];
    const SORT_PARAMETERS = ['relevance', 'novelty', '-novelty', 'price', '-price', '-popularity'];
    const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS'];
    const RELATION_PARAMETERS = ['seo',];

    public function toArray($request)
    {
        $attributes = $this->resource->attributesToArray();
        if($request->get('seo')) {
            $attributes['seo'] = $this->resource->seo->seoAttributesToArray();
        }

        return $attributes;
    }
}
