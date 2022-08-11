<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_types_id',
        'name',
        'slug',
    ];


    /**
     * @return HasMany
     */
    public function userPermissions(): HasMany
    {
        return $this->hasMany(UserPermission::class, 'permissions_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function module(): HasOne
    {
        return $this->hasOne(Module::class, 'id', 'modules_id');
    }
}
