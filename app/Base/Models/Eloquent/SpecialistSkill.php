<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialistSkill extends Model
{
    use SoftDeletes;

    protected $table = 'specialists_skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialists_id',
        'skills_id',
    ];

    /**
     * @return HasOne
     */
    public function specialist(): HasOne
    {
        return $this->hasOne(Specialist::class, 'id', 'specialists_id');
    }

    /**
     * @return HasOne
     */
    public function skill(): HasOne
    {
        return $this->hasOne(Skill::class, 'id', 'skills_id');
    }
}
