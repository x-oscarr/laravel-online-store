<?php

namespace App\Http\Resources;


class CategoryResource extends BaseResource
{
    const ATTR_PARAMETERS = ['parent_id', 'type', 'position', 'category_id',];
    const SORT_PARAMETERS = ['relevance', 'novelty', '-novelty'];
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
