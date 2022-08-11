<?php

namespace App\Auth\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    use ResponseBase;

    public function __construct()
    {
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function handler(): JsonResponse
    {
        auth('api')->logout();

        return $this->response('success');
    }

}
