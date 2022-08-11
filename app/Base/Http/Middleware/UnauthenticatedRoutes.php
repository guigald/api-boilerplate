<?php

namespace App\Base\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnauthenticatedRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!!$this->checkApiKey($request->header('api-key'))) {
            return $next($request);
        }
        return new JsonResponse('Unauthorized', 401);
    }

    /**
     * @param string|null $apiKey
     * @return bool
     */
    private function checkApiKey(?string $apiKey): bool
    {
        if (empty($apiKey)) {
            return false;
        }

        if (!str_contains(env('API_KEY'), $apiKey)) {
            return false;
        }

        return true;
    }
}
