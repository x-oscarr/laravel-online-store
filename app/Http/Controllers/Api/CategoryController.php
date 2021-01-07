<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $abilities = CategoryResource::apiScopes('read');
        $this->checkAccess($abilities);
        $categoryQuery = Category::query();
        $categoryQuery = $this->queryWithSearch($categoryQuery, $request, CategoryResource::SEARCH_MODE_PARAMETERS);
        $categoryQuery = $this->queryWithParams($categoryQuery, $request, CategoryResource::ATTR_PARAMETERS);
        $categoryQuery = $this->queryWithSort($categoryQuery, $request, CategoryResource::SORT_PARAMETERS);
        $categoryQuery = $this->queryWithLimits($categoryQuery, $request);
        return CategoryResource::collection($categoryQuery->get());
    }

    public function store(CreateCategoryRequest $request): CategoryResource
    {
        $abilities = CategoryResource::apiScopes('create');
        $this->checkAccess($abilities);
        $category = Category::create($request->all());
        return new CategoryResource($category);
    }

    public function show(Category $category): CategoryResource
    {
        $abilities = CategoryResource::apiScopes('read');
        $this->checkAccess($abilities);
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $abilities = CategoryResource::apiScopes('update');
        $this->checkAccess($abilities);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $abilities = CategoryResource::apiScopes('delete');
        $this->checkAccess($abilities);
        $category->delete();
        return $this->response([null, Response::HTTP_OK]);
    }
}
