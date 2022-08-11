<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanClient extends Model
{
    use SoftDeletes;

    protected $table = 'plans_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialists_audit_plans_id',
        'clients_id',
        'results',
    ];

    /**
     * @return BelongsTo
     */
    public function specialistAuditPlan(): BelongsTo
    {
        return $this->belongsTo(SpecialistAuditPlan::class, 'id', 'specialists_audit_plans_id');
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id', 'clients_id');
    }
}
