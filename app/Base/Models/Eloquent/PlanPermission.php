<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanPermission extends Model
{
    use SoftDeletes;

    protected $table = 'plans_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plans_id',
        'permissions_id',
    ];

    public function permission(): hasOne
    {
        return $this->hasOne(Permission::class, 'id', 'permissions_id');
    }
}
