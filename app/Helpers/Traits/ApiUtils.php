<?php


namespace App\Helpers\Traits;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiUtils
{
    static public function apiResponse(?array $data, int $status = null): JsonResponse
    {
        return FacadeResponse::json($data, $status ?? Response::HTTP_OK);
    }

    static public function apiErrorResponse(string $key, ?array $data): JsonResponse
    {
        $errorInfo = config('sanctum.errors.'.$key);
        $responseData = ['key' => $key];
        $accessToken = Auth::user()->currentAccessToken();
        if($errorInfo) {
            [
                'status' => $status,
                'message' => $message
            ] = $errorInfo;

            $responseData = [
                'error' => $key,
                'message' => trans($message, $data),
                'user_id' => Auth::user()->id ?? null,
                'scopes' => $accessToken->abilities ?? null
            ];
        }

        return FacadeResponse::json($responseData, $status ?? Response::HTTP_BAD_REQUEST);
    }
}
