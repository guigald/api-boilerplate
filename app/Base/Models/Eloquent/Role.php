<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public const USER = 1;
    public const SPECIALIST = 2;
    public const ADMINISTRATOR = 3;


    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * @return HasMany
     */
    public function userRoles(): hasMany
    {
        return $this->hasMany(UserRole::class, 'roles_id', 'id');
    }
}
