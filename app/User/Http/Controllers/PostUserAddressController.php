<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\CreateException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\CreateUserAddressRequest;
use App\User\Services\CreateUserAddressService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PostUserAddressController extends Controller
{
    use ResponseBase;

    public function __construct(
        private CreateUserAddressService $createUserAddressService
    ) {
    }

    /**
     * @param CreateUserAddressRequest $request
     * @return JsonResponse
     */
    public function handle(CreateUserAddressRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $addressId = $this->createUserAddressService
                ->createUserAddress($data);

            return $this->response('created', ['addresses_id' => $addressId]);
        } catch (CreateException $e) {
            return $this->response('error', [], $e);
        }
    }
}
