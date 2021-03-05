<?php

namespace App\Http\Resources;


class CategoryResource extends BaseResource
{
    public const ATTR_PARAMETERS = ['parent_id', 'type', 'position', 'category_id',];
    public const SORT_PARAMETERS = ['relevance', 'novelty', '-novelty',];
    public const SEARCH_MODE_PARAMETERS = ['REGULAR', 'DESCRIPTIONS',];
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
