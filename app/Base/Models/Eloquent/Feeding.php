<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feeding extends Model
{
    use SoftDeletes;

    protected $table = 'feedings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_declarations_id',
        'feeding_types_id',
        'dependents_id',
        'name',
        'document',
        'birthdate',
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
    public function feedingType(): HasOne
    {
        return $this->hasOne(FeedingType::class, 'id', 'feeding_types_id');
    }

    /**
     * @return HasOne
     */
    public function declaration(): HasOne
    {
        return $this->hasOne(TaxDeclaration::class, 'id', 'tax_declarations_id');
    }

    /**
     * @return HasOne
     */
    public function dependent(): HasOne
    {
        return $this->hasOne(Dependent::class, 'id', 'dependents_id');
    }
}
