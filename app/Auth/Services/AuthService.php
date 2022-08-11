<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Exceptions\SpecialistNotValidatedException;
use App\Auth\Repositories\PermissionRepository;
use App\Auth\Repositories\UserRepository;
use App\Base\Helpers\StringHelper;
use App\Base\Models\Eloquent\Permission;
use App\Base\Models\Eloquent\Specialist;
use App\Base\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Collection;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository,
        private PermissionRepository $permissionRepository
    ) {
    }

    /**
     * @param string $token
     * @return array
     * @throws SpecialistNotValidatedException
     */
    public function getResponse(string $token): array
    {
        list($user, $userObject) = $this->getUser();

        if (!$this->checkSpecialistValidated($userObject)) {
            auth('api')->logout();

            throw new SpecialistNotValidatedException();
        }

        $permissions = $this->getPermissions($userObject);
        $plans = $this->getActivePlans($userObject);

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user,
            'plans' => $plans,
            'permissions' => $permissions,
        ];
    }

    /**
     * @param string $basicAuth
     * @return string[]
     */
    public function getCredentials(string $basicAuth = ''): array
    {
        if (empty($basicAuth)) {
            return [];
        }

        $authorizationHash = str_replace('Basic ', '', $basicAuth);
        $authorizationString = base64_decode($authorizationHash);
        $authorizationArray = explode(':', $authorizationString);

        $user = $this->userRepository->fetchOneBy(
            'document',
            current($authorizationArray)
        );

        $email = current($authorizationArray);

        if (!empty($user)) {
            $email = data_get($user, 'email');
        }

        return [
            'email' => $email,
            'password' => next($authorizationArray),
        ];
    }

    /**
     * @return array
     */
    public function getUser(): array
    {
        $user = $this->userRepository
            ->fetchOneBy('id', (string)auth('api')->id());

        $userArray = $user->toArray();

        unset($userArray['phone']);
        unset($userArray['document']);
        unset($userArray['reset_date']);

        $roles = explode('-', $this->getRoles($user));
        $role = end($roles);

        data_set($userArray, 'specialist', $this->getSpecialist($user), []);
        data_set($userArray, 'role', $role, 'none');

        return [$userArray, $user];
    }

    /**
     * @param User $user
     * @return array
     */
    public function getPermissions(User $user): array
    {
        $userPlans = $user->userPlan()->where('active', true)->get();

        return $this->extractPermissions($userPlans, $this->getRoles($user));
    }

    /**
     * @param User|null $user
     * @return Specialist|null
     */
    private function getSpecialist(?User $user): ?array
    {
        $specialist = $user->specialist()->get()->first();

        if ($specialist === null) {
            return null;
        }

        $specialist = $specialist->toArray();

        unset($specialist['users_id']);
        unset($specialist['created_at']);
        unset($specialist['updated_at']);
        unset($specialist['deleted_at']);

        return $specialist;
    }

    /**
     * @param User|null $user
     * @return string
     */
    private function getRoles(?User $user): string
    {
        $userRoles = $user->userRoles()->get();

        $roles = '';

        foreach ($userRoles as $userRole) {
            $role = $userRole->role()->get()->first();
            $roleSlug = data_get($role, 'slug');
            $roles .= (empty($roles)) ? $roleSlug : '-' . $roleSlug;
        }

        return $roles;
    }

    /**
     * @param Collection $userPlans
     * @param string $roles
     * @return array
     */
    private function extractPermissions(
        Collection $userPlans,
        string $roles
    ): array {
        $permissions = [];

        if (str_contains($roles, 'specialist')) {
            $fetchedPermissions = $this->permissionRepository
                ->fetchByRole('specialist');

            foreach ($fetchedPermissions as $permission) {
                $moduleType = $permission
                    ->module()->get()->first()
                    ->moduleType()->get()->first();

                $system = StringHelper::slugToCamel(
                    data_get($moduleType, 'slug')
                );

                $permissions[$system][] = $this
                    ->mountPermissionSlug($permission);
            }

            $fetchedPermissions = $this->permissionRepository
                ->fetchByRole('user');

            foreach ($fetchedPermissions as $permission) {
                $moduleType = $permission
                    ->module()->get()->first()
                    ->moduleType()->get()->first();

                $system = StringHelper::slugToCamel(
                    data_get($moduleType, 'slug')
                );

                $permissions[$system][] = $this
                    ->mountPermissionSlug($permission);
            }

            return $permissions;
        }

        foreach ($userPlans as $userPlan) {
            $plan = $userPlan->plan()->get()->first();
            $planPermissions = $plan->plansPermissions()->get();

            foreach ($planPermissions as $planPermission) {
                $permission = $planPermission->permission()->get()->first();
                $moduleType = $permission
                    ->module()->get()->first()
                    ->moduleType()->get()->first();

                $system = StringHelper::slugToCamel(
                    data_get($moduleType, 'slug')
                );

                if ($this->checkRole($roles, data_get($permission, 'slug'))) {
                    $permissions[$system][] = $this
                        ->mountPermissionSlug($permission);
                }
            }
        }

        return array_unique($permissions);
    }

    /**
     * @param Permission $permission
     * @return string
     */
    private function mountPermissionSlug(Permission $permission): string
    {
        $module = $permission->module()->get()->first();

        return data_get($module, 'slug') . '.' . data_get($permission, 'slug');
    }

    /**
     * @param string $roles
     * @param string $slug
     * @return bool
     */
    private function checkRole(string $roles, string $slug): bool
    {
        $roles = explode('-', $roles);

        foreach ($roles as $role) {
            if (str_contains($slug, $role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getActivePlans(User $user): array
    {
        $plans = [];
        $userPlans = $user->userPlan()->where('active', true)->get();

        foreach ($userPlans as $userPlan) {
            $plan = $userPlan->plan()->get()->first();

            $plans[] = [
                'id' => data_get($plan, 'id'),
                'slug' => data_get($plan, 'slug'),
                'name' => data_get($plan, 'name'),
                'description' => data_get($plan, 'description'),
            ];
        }

        return $plans;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function checkSpecialistValidated(User $user): bool
    {
        $validated = data_get($user, 'specialist.validated');

        if ($validated === null) {
            return true;
        }

        return (bool)$validated;
    }
}
