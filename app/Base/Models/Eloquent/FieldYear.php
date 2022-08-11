<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldYear extends Model
{
    use SoftDeletes;

    protected $table = 'fields_years';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fields_id',
        'years_id',
    ];

    /**
     * @return HasOne
     */
    public function field(): HasOne
    {
        return $this->hasOne(Field::class, 'id', 'fields_id');
    }

    /**
     * @return HasOne
     */
    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'years_id');
    }
}
