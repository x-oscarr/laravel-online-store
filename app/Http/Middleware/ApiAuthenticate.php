<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Session\Middleware\AuthenticateSession;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthenticate extends AuthenticateSession
{

//    public function handle(Request $request, Closure $next)
//    {
//        $acceptHeader = config('sanctum.accept');
////        if($acceptHeader && $request->header('Accept') != $acceptHeader) {
////            return FacadeResponse::json(
////                "This resource required a request header 'Accept' with the value '$acceptHeader' - this is the type of the response you can accept from this resource.",
////                Response::HTTP_BAD_REQUEST
////            );
////        }
//
//        return response()->json(config('sanctum'));
//
//        return $next($request);
//    }
}
