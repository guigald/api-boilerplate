<?php

namespace App\Base\Http\Middleware;

use App\Base\Exceptions\PaymentMissingException;
use App\Base\Traits\ResponseBase;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Nowakowskir\JWT\TokenEncoded;

class CleanPayload
{
    use ResponseBase;

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $request = $this->cleanPayload($request);
        } catch (Exception $e) {
            return $this->response('error', [], $e);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @return Request
     */
    private function cleanPayload(Request $request): Request
    {
        foreach ($request->all() as $key => $value) {
            if ($value === null) {
                $request->request->remove($key);
            }
        }

        return $request;
    }
}
