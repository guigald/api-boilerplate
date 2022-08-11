<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialist extends Model
{
    use SoftDeletes;

    protected $table = 'specialists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'specialist_document_types_id',
        'specialist_document',
        'validated',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * @return HasOne
     */
    public function documentType(): HasOne
    {
        return $this->hasOne(SpecialistDocumentType::class, 'id', 'specialist_document_types_id');
    }

    /**
     * @return HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(SpecialistEmail::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(SpecialistPhone::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(SpecialistAddress::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function specialistSkills(): HasMany
    {
        return $this->hasMany(SpecialistSkill::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function specialistPlans(): HasMany
    {
        return $this->hasMany(SpecialistAuditPlan::class, 'specialists_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function schedule(): HasOne
    {
        return $this->hasOne(Schedule::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'specialists_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function authorizations(): HasMany
    {
        return $this->hasMany(Authorization::class, 'specialists_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function specialistCompany(): HasOne
    {
        return $this->hasOne(SpecialistCompany::class, 'specialists_id', 'id');
    }
}
