<?php

namespace App\Base\Models\Eloquent;

use App\Base\Models\Eloquent\Legacy\LegacyDeclaration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plans_id',
        'name',
        'email',
        'document',
        'birthdate',
        'met_id',
        'password',
        'newsletter',
        'accepted_terms',
        'reset_date',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [];

    /**
     * @var mixed
     */
    private mixed $email;

    /**
     * @var mixed
     */
    private mixed $name;

    /**
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @return HasOne
     */
    public function specialist(): hasOne
    {
        return $this->hasOne(Specialist::class, 'users_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function legacyDeclaration(): hasOne
    {
        return $this->hasOne(LegacyDeclaration::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userPlan(): HasMany
    {
        return $this->hasMany(UserPlan::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userPermissions(): HasMany
    {
        return $this->hasMany(UserPermission::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userRoles(): hasMany
    {
        return $this->hasMany(UserRole::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(RequestStatusLog::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function declarations(): HasMany
    {
        return $this->hasMany(TaxDeclaration::class, 'users_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'users_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'users_id', 'id');
    }
}
