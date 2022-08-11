<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanModule extends Model
{
    use SoftDeletes;

    protected $table = 'plans_modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plans_id',
        'modules_id',
    ];

    /**
     * @return HasOne
     */
    public function plan(): HasOne
    {
        return $this->hasOne(Field::class, 'id', 'plans_id');
    }

    /**
     * @return HasOne
     */
    public function module(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'modules_id');
    }
}
