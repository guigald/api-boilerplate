<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Traits\ResponseBase;
use App\User\Exceptions\UserNotFoundException;
use App\User\Services\LoaderUserService;
use Illuminate\Http\JsonResponse;

class GetUserLegacyDeclarationController extends Controller
{
    use ResponseBase;

    public function __construct(
        private LoaderUserService $loaderUserService
    ) {
    }

    /**
     * @param int $legacyDeclarationId
     * @return JsonResponse
     */
    public function handle(int $legacyDeclarationId): JsonResponse
    {
        try {
            $user = $this->loaderUserService
                ->getUserByLegacyDeclarationId($legacyDeclarationId);

            return $this->response('success', $user->toArray());
        } catch (UserNotFoundException $e) {
            return $this->response('error', [], $e);
        }
    }
}
