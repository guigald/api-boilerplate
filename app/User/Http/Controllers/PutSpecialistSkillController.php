<?php

declare(strict_types=1);

namespace App\User\Http\Controllers;

use App\Base\Exceptions\CreateException;
use App\Base\Http\Controllers\Controller;
use App\User\Http\Requests\EditSpecialistSkillRequest;
use App\User\Services\EditSpecialistSkillService;
use App\Base\Traits\ResponseBase;
use Illuminate\Http\JsonResponse;

class PutSpecialistSkillController extends Controller
{
    use ResponseBase;

    public function __construct(
        private EditSpecialistSkillService $editSpecialistSkillService
    ) {
    }

    /**
     * @param EditSpecialistSkillRequest $request
     * @param int $specialistId
     * @return JsonResponse
     */
    public function handle(
        EditSpecialistSkillRequest $request,
        int $specialistId
    ): JsonResponse {
        $data = $request->validated();

        try {
            $this->editSpecialistSkillService
                ->editSpecialistSkill($specialistId, $data);

            return $this->response('updated');
        } catch (CreateException $e) {
            return $this->response('error', [], $e);
        }
    }
}
