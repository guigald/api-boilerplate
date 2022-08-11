<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\User\Exceptions\UserNotFoundException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\PasswordRecoverRequest;
use App\User\Services\RecoverUserPasswordService;
use App\Base\Traits\ResponseBase;
use Exception;
use Illuminate\Http\JsonResponse;
use SendGrid\Mail\TypeException;
use Throwable;

class PostPasswordRecoverController extends Controller
{
    use ResponseBase;

    public function __construct(
        private RecoverUserPasswordService $recoverUserPasswordService
    ) {
    }

    /**
     * @param PasswordRecoverRequest $request
     * @return JsonResponse
     */
    public function handle(
        PasswordRecoverRequest $request
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->recoverUserPasswordService
                ->sendRecoverPassword(data_get($data, 'identification'));

            return $this->response('success');
        } catch (UserNotFoundException $e) {
            return $this->response('error', [], $e);
        } catch (TypeException | Throwable $e) {
            return $this->response(
                'error',
                [],
                new Exception($e->getMessage())
            );
        }
    }
}
