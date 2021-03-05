<?php

namespace App\Http\Resources;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

abstract class BaseResource extends JsonResource
{
    public const GLOBAL_ABILITY_ROOT = 'global';
    public const ABILITIES = ['create', 'read', 'update', 'delete',];
    public const ATTR_PARAMETERS = [];
    public const SORT_PARAMETERS = [];
    public const SEARCH_MODE_PARAMETERS = [];
    public const RELATION_PARAMETERS = [];

    public function toArray($request): array
    {
        return parent::toArray($request);
    }

    public static function apiScopes(string $type, bool $isGlobal = false): array
    {
        $resourceAbilities = self::ABILITIES ?? ['read'];
        $prefix = self::getScopePrefix();
        $root = $isGlobal ? ':' . self::GLOBAL_ABILITY_ROOT : '';
        if ($type === '*') {
            return array_map(static function ($type) use (&$prefix, &$root) {
                return "$prefix:$type$root";
            }, $resourceAbilities);
        }
        return ["$prefix:$type$root"];
    }

    public static function abilityAccess(string $ability, $isGlobal = false): bool
    {
        $user = Auth::user();
        $root = $isGlobal ? ':' . self::GLOBAL_ABILITY_ROOT : '';
        $scope = self::getScopePrefix() . ':' . $ability . $root;

        if ($user->tokenCan($scope)) {
            return true;
        }
        return false;
    }

    public static function isGlobalScope($scope): bool
    {
        return (bool)strripos($scope, ':' . self::GLOBAL_ABILITY_ROOT);
    }

    protected static function getScopePrefix(): string
    {
        $prefix = str_replace('Resource', '', last(explode("\\", static::class)));
        return strtolower($prefix);
    }
}
