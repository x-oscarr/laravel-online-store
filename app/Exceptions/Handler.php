<?php

namespace App\Exceptions;

use App\Helpers\Utils;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
//        $this->renderable(function (NotFoundHttpException $exception) {
//            if(Request::route()->action && in_array('api', Request::route()->action['middleware'])) {
//                return Utils::apiErrorResponse('resource_item_not_found', [
//                    'parameter' => 'd',
//                    'value' => 'd'
//                ]);
//            }
//        });
    }

    public function render($request, Throwable $e)
    {
        // @TODO: ModelNotFoundException is not caught in the register method
//        if($e instanceof ModelNotFoundException) {
//            if(Request::route()->action && in_array('api', Request::route()->action['middleware'])) {
//                return Utils::apiErrorResponse('resource_item_not_found', [
//                    'value' => $e->getIds()[0]
//                ]);
//            }
//        }
        return parent::render($request, $e);
    }
}
