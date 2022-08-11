<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Base\Models\Eloquent\User;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    use RepositoryBase;

    public function __construct(private User $model)
    {
    }

    /**
     * @param array $search
     * @return User|null
     */
    public function fetchOneByMultiple(array $search): ?User
    {
        if (empty($search)) {
            return null;
        }

        $query = $this->model->select();

        foreach ($search as $key => $value) {
            $query->where($key, $value);
        }

        return $query->get()->first();
    }

    /**
     * @param string $hash
     * @return User|null
     */
    public function getUserByHash(string $hash): ?User
    {
        return $this->model
            ->where(DB::raw("md5(concat(email, reset_date))"), $hash)
            ->get()
            ->first();
    }

    public function fetchOneById(int $value): ?User
    {
        return $this->model->where('id', $value)->get()->first();
    }

    /**
     * @param int $userId
     * @param string|null $email
     * @param string|null $document
     * @return User|null
     */
    public function fetchOneByEmailOrDocument(
        int $userId,
        ?string $email,
        ?string $document
    ): ?User {
        $db = $this->model->where('id', '<>', $userId);

        if ($email !== null) {
            $db->where('email', $email);
        }

        if ($document !== null) {
            $db->where('document', $document);
        }

        return $db->get()->first();
    }

    /**
     * @param $email
     * @return User|null
     */
    public function fetchOneByEmail($email): ?User
    {
        return $this->model->where('email', $email)->get()->first();
    }

    /**
     * @param $document
     * @return User|null
     */
    public function fetchOneByDocument($document): ?User
    {
        return $this->model->where('document', $document)->get()->first();
    }

    /**
     * @param int $userId
     * @return User|null
     */
    public function getUserUnauthenticatedById(int $userId): ?User
    {
        return $this->model
            ->select([
                'name',
                'email',
                'phone'
            ])
            ->where('id', $userId)
            ->get()
            ->first();
    }

    /**
     * @param int $legacyDeclarationId
     * @return User|null
     */
    public function getUserByLegacyDeclarationId(
        int $legacyDeclarationId
    ): ?User {
        return $this->model
            ->selectRaw("
                users.id,
                users.name,
                users.email,
                users.phone,
                users.document,
                DATE_FORMAT(users.birthdate, '%d/%m/%Y') as birthdate
            ")
            ->join(
                'legacy_declarations as ld',
                'ld.users_id',
                'users.id'
            )
            ->where('ld.id', $legacyDeclarationId)
            ->get()
            ->first();
    }

    /**
     * @param int $legacyDeclarationId
     * @return User|null
     */
    public function getSpecialistUserByLegacyDeclarationId(
        int $legacyDeclarationId
    ): ?User {
        return $this->model
            ->selectRaw("
                users.id,
                users.name,
                users.email,
                users.phone,
                users.document,
                DATE_FORMAT(users.birthdate, '%d/%m/%Y') as birthdate
            ")
            ->join(
                'specialists as s',
                's.users_id',
                'users.id'
            )->join(
                'legacy_declarations as ld',
                'ld.specialists_id',
                's.id'
            )
            ->where('ld.id', $legacyDeclarationId)
            ->get()
            ->first();
    }

    /**
     * @param int $userId
     * @param string $system
     * @return User|null
     */
    public function getUserPlan(int $userId, string $system): ?User
    {
        return $this->model
            ->selectRaw("
                up.active,
                p.slug
            ")
            ->join('users_plans as up', 'up.users_id', 'users.id')
            ->join('plans as p', 'p.id', 'up.plans_id')
            ->where('users.id', $userId)
            ->where('p.system', $system)
            ->orderBy('p.id', 'DESC')
            ->get()
            ->first();
    }
}
