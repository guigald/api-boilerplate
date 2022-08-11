<?php

namespace App\Base\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return response()
                    ->json(['status' => __('exceptions.token.invalid')], 401);
            }

            if ($exception instanceof TokenExpiredException) {
                return response()
                    ->json(['status' => __('exceptions.token.expired')], 401);
            }

            return response()
                ->json(['status' => __('exceptions.token.not-found')], 401);
        }

        return $next($request);
    }
}
