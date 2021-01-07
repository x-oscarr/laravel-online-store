<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response;

class SliderController extends ApiController
{

    public function index(Request $request): AnonymousResourceCollection
    {
        $abilities = SliderResource::apiScopes('read');
        $this->checkAccess($abilities);
        $productQuery = Slider::query();
        $productQuery = $this->queryWithSearch($productQuery, $request, ProductResource::SEARCH_MODE_PARAMETERS);
        $productQuery = $this->queryWithParams($productQuery, $request, ProductResource::ATTR_PARAMETERS);
        $productQuery = $this->queryWithSort($productQuery, $request, ProductResource::SORT_PARAMETERS);
        $productQuery = $this->queryWithLimits($productQuery, $request);
        return SliderResource::collection($productQuery->get());
    }

    public function store(Request $request): SliderResource
    {
        $abilities = SliderResource::apiScopes('create');
        $this->checkAccess($abilities);
        $product = Slider::create($request->all());
        return new SliderResource($product);
    }

    public function show(Slider $slider): SliderResource
    {
        $abilities = SliderResource::apiScopes('read');
        $this->checkAccess($abilities);
        return new SliderResource($slider);
    }

    public function update(Request $request, Slider $slider): SliderResource
    {
        $abilities = SliderResource::apiScopes('update');
        $this->checkAccess($abilities);
        $slider->update($request->all());
        return new SliderResource($slider);
    }

    public function destroy(Slider $slider): JsonResponse
    {
        $abilities = SliderResource::apiScopes('delete');
        $this->checkAccess($abilities);
        $slider->delete();
        return $this->response([null, Response::HTTP_OK]);
    }
}
