<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_types_id',
        'name',
    ];

    /**
     * @return HasOne
     */
    public function moduleType(): HasOne
    {
        return $this->hasOne(ModuleType::class, 'id', 'module_types_id');
    }

    /**
     * @return HasOne
     */
    public function form(): HasOne
    {
        return $this->hasOne(Form::class, 'id', 'modules_id');
    }

    /**
     * @return HasMany
     */
    public function plansModules(): hasMany
    {
        return $this->hasMany(PlanModule::class, 'modules_id', 'id');
    }
}
