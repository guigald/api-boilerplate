<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialistAuditPlan extends Model
{
    use SoftDeletes;

    protected $table = 'specialists_audit_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialists_id',
        'audit_plans_id',
        'total',
        'remaining',
    ];

    /**
     * @return HasOne
     */
    public function plan(): HasOne
    {
        return $this->hasOne(AuditPlan::class, 'id', 'audit_plans_id');
    }

    /**
     * @return HasOne
     */
    public function specialist(): HasOne
    {
        return $this->hasOne(Specialist::class, 'id', 'specialists_id');
    }
}
