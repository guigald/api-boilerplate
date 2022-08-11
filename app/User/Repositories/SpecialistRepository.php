<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\Specialist;
use App\Base\Traits\RepositoryBase;

class SpecialistRepository
{
    use RepositoryBase;

    public function __construct(private Specialist $model)
    {
    }

    /**
     * @param string $document
     * @param int $documentTypeId
     * @return Specialist|null
     */
    public function fetchOneByDocument(
        string $document,
        int $documentTypeId
    ): ?Specialist {
        return $this->model
            ->where('specialist_document_types_id', $documentTypeId)
            ->where('specialist_document', $document)
            ->get()
            ->first();
    }

    /**
     * @param int $specialistId
     * @return Specialist|null
     */
    public function fetchOneById(int $specialistId): ?Specialist
    {
        return $this->model
            ->selectRaw("
                specialists.specialist_document,
                specialists.specialist_document_types_id,
                sdt.name as specialist_document_types_name,
                specialists.validated
            ")
            ->leftJoin(
                'specialist_document_types as sdt',
                'specialists.specialist_document_types_id',
                'sdt.id'
            )
            ->where('specialists.id', $specialistId)
            ->get()
            ->first();
    }

    public function fetchSpecialistByUserId(int $userId): ?Specialist
    {
        return $this->model
            ->where('users_id', $userId)
            ->get()
            ->first();
    }
}
