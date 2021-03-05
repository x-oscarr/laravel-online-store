<?php


namespace App\Scopes\Local;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

trait FindBySlugScope
{
    public function scopeSlug(Builder $query, string $slug)
    {
        return $query
            ->where('slug', $slug);
    }

    public function scopeSlugOrFail(Builder $query, string $slug)
    {
        $model = $query
            ->where('slug', $slug)
            ->first();

        if(!$model) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $model;
    }
}
