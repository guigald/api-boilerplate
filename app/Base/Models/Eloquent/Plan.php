<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';

    public const AUDIT = 'audit';
    public const DEFINITIVE_DEPARTURE = 'definitive-departure';
    public const LEGACY_IRPRONTO = 'irpronto-legacy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return HasMany
     */
    public function plansModules(): hasMany
    {
        return $this->hasMany(PlanModule::class, 'plans_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function plansPermissions(): hasMany
    {
        return $this->hasMany(PlanPermission::class, 'plans_id', 'id');
    }
}
