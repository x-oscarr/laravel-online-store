<?php

namespace App\Http\Resources;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

abstract class BaseResource extends JsonResource
{
    const GLOBAL_ABILITY_ROOT = 'global';

    const ABILITIES = ['create', 'read', 'update', 'delete',];
    const ATTR_PARAMETERS = [];
    const SORT_PARAMETERS = [];
    const SEARCH_MODE_PARAMETERS = [];
    const RELATION_PARAMETERS = [];

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    static public function apiScopes(string $type, bool $isGlobal = false): array
    {
        $resourceAbilities = self::ABILITIES ?? ['read'];
        $prefix = self::getScopePrefix();
        $root = $isGlobal ? ':' . BaseResource::GLOBAL_ABILITY_ROOT : '';
        if ($type == '*') {
            return array_map(function ($type) use (&$prefix, &$root) {
                return "$prefix:$type$root";
            }, $resourceAbilities);
        }
        return ["$prefix:$type$root"];
    }

    static public function abilityAccess(string $ability, $isGlobal = false): bool
    {
        $user = Auth::user();
        $root = $isGlobal ? ':' . BaseResource::GLOBAL_ABILITY_ROOT : '';
        $scope = self::getScopePrefix() . ':' . $ability . $root;

        if ($user->tokenCan($scope)) {
            return true;
        }
        return false;
    }

    static public function isGlobalScope($scope): bool
    {
        return (bool)strripos($scope, ':' . BaseResource::GLOBAL_ABILITY_ROOT);
    }

    static protected function getScopePrefix(): string
    {
        $prefix = str_replace('Resource', '', last(explode("\\", get_called_class())));
        return strtolower($prefix);
    }
}
