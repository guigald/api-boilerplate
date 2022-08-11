<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPlan extends Model
{
    use SoftDeletes;

    protected $table = 'users_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'plans_id',
        'results',
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
    public function plan(): HasOne
    {
        return $this->hasOne(Plan::class, 'id', 'plans_id');
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'users_plans_id', 'id');
    }
}
