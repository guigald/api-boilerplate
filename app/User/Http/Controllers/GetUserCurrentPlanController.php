<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\User\Exceptions\UserNotFoundException;
use App\User\Services\LoaderUserPlanService;
use Illuminate\Http\JsonResponse;

class GetUserCurrentPlanController extends Controller
{
    use ResponseBase;

    public function __construct(
        private LoaderUserPlanService $loaderUserPlanService
    ) {
    }

    /**
     * @param int $userId
     * @param string $system
     * @return JsonResponse
     */
    public function handle(int $userId, string $system): JsonResponse
    {
        try {
            $plan = $this->loaderUserPlanService
                ->getUserPlan($userId, $system);

            return $this->response('success', $plan);
        } catch (
            UserNotFoundException $e
        ) {
            return $this->response('error', [], $e);
        }
    }
}
