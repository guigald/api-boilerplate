<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\UpdateException;
use App\Base\Models\Eloquent\Specialist;
use App\User\Exceptions\SpecialistAlreadyExistsException;
use App\User\Repositories\SpecialistRepository;

class EditSpecialistService
{
    public function __construct(
        private SpecialistRepository $specialistRepository
    ) {
    }

    /**
     * @param int $specialistId
     * @param array $data
     * @throws SpecialistAlreadyExistsException
     * @throws UpdateException
     */
    public function editSpecialist(int $specialistId, array $data): void
    {
        $documentTypeId = data_get($data, 'specialist_document_types_id', null);
        $document = data_get($data, 'specialist_document', null);

        if ($document !== null && $documentTypeId !== null) {
            $specialist = $this->getSpecialistByDocument(
                $documentTypeId,
                $document
            );

            if (
                $specialist !== null &&
                data_get($specialist, 'id') !== $specialistId
            ) {
                throw new SpecialistAlreadyExistsException();
            }
        }

        $this->specialistRepository->update($specialistId, $data);
    }

    /**
     * @param int $documentTypeId
     * @param string $document
     * @return Specialist|null
     */
    private function getSpecialistByDocument(
        int $documentTypeId,
        string $document
    ): ?Specialist {
        return $this->specialistRepository
            ->fetchOneByDocument($document, $documentTypeId);
    }
}
