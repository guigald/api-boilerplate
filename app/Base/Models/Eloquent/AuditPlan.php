<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditPlan extends Model
{
    use SoftDeletes;

    protected $table = 'audit_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'amount',
        'price',
        'description',
    ];

    /**
     * @return HasMany
     */
    public function specialistPlans(): HasMany
    {
        return $this->hasMany(SpecialistAuditPlan::class, 'audit_plans_id', 'id');
    }
}
