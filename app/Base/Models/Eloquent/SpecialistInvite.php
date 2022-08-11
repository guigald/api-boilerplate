<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialistInvite extends Model
{
    use SoftDeletes;

    protected $table = 'specialist_invites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companies_id',
        'email',
        'invite_accepted',
    ];

    /**
     * @return HasMany
     */
    public function company(): HasMany
    {
        return $this->hasMany(Company::class, 'id', 'companies_id');
    }
}
