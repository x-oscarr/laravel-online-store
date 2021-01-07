<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


class ProductController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $abilities = ProductResource::apiScopes('read');
        $this->checkAccess($abilities);
        $productQuery = Product::query();
        $productQuery = $this->queryWithSearch($productQuery, $request, ProductResource::SEARCH_MODE_PARAMETERS);
        $productQuery = $this->queryWithParams($productQuery, $request, ProductResource::ATTR_PARAMETERS);
        $productQuery = $this->queryWithSort($productQuery, $request, ProductResource::SORT_PARAMETERS);
        $productQuery = $this->queryWithLimits($productQuery, $request);
        return ProductResource::collection($productQuery->get());
    }

    public function store(CreateProductRequest $request): ProductResource
    {
        $abilities = ProductResource::apiScopes('create');
        $this->checkAccess($abilities);
        $product = Product::create($request->all());
        return new ProductResource($product);
    }

    public function show(Product $product): ProductResource
    {
        $abilities = ProductResource::apiScopes('read');
        $this->checkAccess($abilities);
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $abilities = ProductResource::apiScopes('update');
        $this->checkAccess($abilities);
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy(Product $product): void
    {
        $abilities = ProductResource::apiScopes('delete');
        $this->checkAccess($abilities);
        $product->delete();
        $this->response([null, Response::HTTP_OK]);
    }
}
