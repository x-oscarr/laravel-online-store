<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    protected function response(?array $data = null, ?int $status = null): JsonResponse
    {
        return Utils::apiResponse($data, $status);
    }

    protected function error(string $key, ?array $data): JsonResponse
    {
        return Utils::apiErrorResponse($key, $data);
    }

    protected function checkAccess(array $scopes, bool $onlyGlobal = false): void
    {
        $notEnoughScopes = [];
        $user = Auth::user();

        foreach ($scopes as $scope) {
            if(BaseResource::isGlobalScope($scope) && !$onlyGlobal) {
                $scopes = str_replace(':' . BaseResource::GLOBAL_ABILITY_ROOT, '', $scopes);
            }

            if ($user->tokenCan($scope)) {
                continue;
            }

            $notEnoughScopes[] = $scope;
        }

        if(!empty($notEnoughScopes)) {
            throw new HttpResponseException($this->error('access_error', [
                'scopes' => implode(', ', $notEnoughScopes)
            ]));
        }
    }

    // Queries

    protected function queryWithLimits(Builder $builder, Request $request): Builder
    {
        $maxLimit = config('sanctum.settings.limit');
        $limit = $request->get('limit', $maxLimit);
        $builder
            ->offset($request->get('offset') ?? 0)
            ->limit(($limit > $maxLimit) ? $maxLimit : $limit);

        return $builder;
    }

    protected function queryWithSort(Builder $builder, Request $request, ?array $sortTypeList = null): Builder
    {

        $sortValue = $request->get('sort', null);
        $sortConfig = config('sanctum.settings.sort');
        $sortTypeList = $sortTypeList ?? array_keys($sortConfig);

        if(in_array($sortValue, $sortTypeList, true) && $sortValue && is_array($sortConfig[$sortValue])) {
            [$column, $direction] = $sortConfig[$sortValue];
            $builder->orderBy($column, $direction);
        }
        return $builder;
    }

    protected function queryWithParams(Builder $builder, Request $request, array $attributesParams): Builder
    {
        foreach ($attributesParams as $paramName) {
            $paramData = $request->get($paramName);

            if (is_array($paramData)) {
                $builder->whereIn($paramName, $paramData);

            } elseif(is_string($paramData) || is_int($paramData) | is_float($paramData) || is_bool($paramData)) {
                $builder->where($paramName, $paramData);
            } else {
                $paramMin = $request->get($paramName . '_min');
                $paramMax = $request->get($paramName . '_max');
                if ($paramMin) {
                    $builder->where($paramName, '>=', $paramMin);
                }
                if ($paramMax) {
                    $builder->where($paramName, '<=', $paramMax);
                }
            }
        }
        return $builder;
    }

    protected function queryWithSearch(Builder $builder, Request $request, ?array $searchTypeList = null): Builder
    {
        $searchString = $request->get('search');
        $searchMode = $request->get('searchMode', config('sanctum.settings.search_mode.REGULAR'));
        $searchConfig = config('sanctum.settings.search_mode');
        $searchTypeList = $searchTypeList ?? array_keys($searchConfig);

        if(in_array($searchMode, $searchTypeList, true) && $searchConfig[$searchMode]) {
            foreach ($searchConfig[$searchMode] as $column) {
                $parts = explode('.', $column);
                if(count($parts) === 2) {
                    [$table, $column] = $parts;
                    $builder->whereHas($table, function (Builder $builder) use (&$searchString, &$column) {
                        $builder->where($column, 'LIKE', "%$searchString%");
                    });
                } else {
                    $builder->where($column, 'LIKE', "%$searchString%");
                }
            }
        }
        return $builder;
    }
}
