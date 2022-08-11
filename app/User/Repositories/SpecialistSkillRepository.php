<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\SpecialistSkill;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Collection;

class SpecialistSkillRepository
{
    use RepositoryBase;

    public function __construct(private SpecialistSkill $model)
    {
    }

    /**
     * @param int $specialistId
     * @return Collection
     */
    public function fetchSkillsBySpecialistId(int $specialistId): Collection
    {
        return $this->model
            ->selectRaw("
                specialists_skills.skills_id,
                s.name as skills_name
            ")
            ->leftJoin(
                'skills as s',
                'specialists_skills.skills_id',
                's.id'
            )
            ->where('specialists_id', $specialistId)
            ->get();
    }
}
