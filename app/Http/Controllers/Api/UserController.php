<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends ApiController
{

    public function index(Request $request): AnonymousResourceCollection
    {
        $accessAbility = 'read';
        $abilities = UserResource::apiScopes($accessAbility, true);
        $this->checkAccess($abilities, true);

        $userQuery = User::query();
        $userQuery = $this->queryWithSearch($userQuery, $request, UserResource::SEARCH_MODE_PARAMETERS);
        $userQuery = $this->queryWithParams($userQuery, $request, UserResource::ATTR_PARAMETERS);
        $userQuery = $this->queryWithSort($userQuery, $request, UserResource::SORT_PARAMETERS);
        $userQuery = $this->queryWithLimits($userQuery, $request);
        return UserResource::collection($userQuery->get());
    }

    public function store(CreateUserRequest $request): UserResource
    {
        $abilities = UserResource::apiScopes('create');
        $this->checkAccess($abilities);
        $product = User::create($request->all());

        return new UserResource($product);
    }

    public function show(User $user)
    {
        $accessAbility = 'read';
        $abilities = UserResource::apiScopes($accessAbility);
        $this->checkAccess($abilities);

        if(UserResource::abilityAccess($accessAbility) && $user->id != Auth::user()->id) {
            return $this->error('access_error', [
                'scopes' => UserResource::apiScopes($accessAbility, true)[0]
            ]);
        }

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $accessAbility = 'update';
        $abilities = UserResource::apiScopes($accessAbility);
        $this->checkAccess($abilities);

        if(UserResource::abilityAccess($accessAbility) && $user->id != Auth::user()->id) {
            return $this->error('access_error', [
                'scopes' => UserResource::apiScopes($accessAbility, true)[0]
            ]);
        }

        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $abilities = UserResource::apiScopes('delete');
        $this->checkAccess($abilities);

        $user->delete();
        return $this->response([null, Response::HTTP_OK]);
    }
}
