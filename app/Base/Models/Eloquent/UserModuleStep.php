<?php

namespace App\Base\Models\Eloquent;

use Google\Service\Dataflow\Step;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModuleStep extends Model
{
    use SoftDeletes;

    protected $table = 'users_modules_steps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modules_id',
        'step',
        'users_id',
        'form',
    ];

    /**
     * @return HasOne
     */
    public function module(): HasOne
    {
        return $this->hasOne(Module::class, 'id', 'modules_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
