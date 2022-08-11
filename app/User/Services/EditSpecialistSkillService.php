<?php

declare(strict_types=1);

namespace App\User\Services;

use App\Base\Exceptions\CreateException;
use App\User\Repositories\SpecialistSkillRepository;

class EditSpecialistSkillService
{
    public function __construct(
        private SpecialistSkillRepository $specialistSkillRepository
    ) {
    }

    /**
     * @param int $specialistId
     * @param array $data
     * @throws CreateException
     */
    public function editSpecialistSkill(int $specialistId, array $data): void
    {
        $currentSkills = $this->specialistSkillRepository
            ->fetchAllBy('specialists_id', (string)$specialistId)
            ->toArray();

        foreach (data_get($data, 'skills') as $skill) {
            $skillId = data_get($skill, 'skills_id');
            $index = $this->checkSkill($skillId, $currentSkills);

            if ($index !== null) {
                unset($currentSkills[$index]);
                continue;
            }

            $this->specialistSkillRepository->create([
                'specialists_id' => $specialistId,
                'skills_id' => $skillId,
            ]);
        }

        foreach ($currentSkills as $skillToRemove) {
            $this->specialistSkillRepository
                ->forceDelete(data_get($skillToRemove, 'id'));
        }
    }

    /**
     * @param int $skillId
     * @param array $currentSkills
     * @return int|null
     */
    private function checkSkill(int $skillId, array $currentSkills): ?int
    {
        foreach ($currentSkills as $key => $skill) {
            if (data_get($skill, 'id') === $skillId) {
                return $key;
            }
        }

        return null;
    }
}
