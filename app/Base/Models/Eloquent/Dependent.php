<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependent extends Model
{
    use SoftDeletes;

    protected $table = 'dependents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_declarations_id',
        'dependent_types_id',
        'name',
        'document',
        'birthdate',
        'email',
        'ddd',
        'cellphone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tax_declarations_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return HasOne
     */
    public function dependentType(): HasOne
    {
        return $this->hasOne(DependentType::class, 'id', 'dependent_types_id');
    }
}
