<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DependentType extends Model
{
    use SoftDeletes;

    protected $table = 'dependent_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'label',
    ];

    public function dependents(): HasMany
    {
        return $this->hasMany(Dependent::class, 'dependent_types_id', 'id');
    }
}
