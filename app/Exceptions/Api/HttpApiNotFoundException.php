<?php

namespace App\Exceptions\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HttpApiNotFoundException extends BaseHttpApiException
{
    const CODE = 404;

    public static function render(): Closure
    {
        return function (NotFoundHttpException $exception, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'API request not found.'
                ], self::CODE);
            }
            return null;
        };
    }
}
