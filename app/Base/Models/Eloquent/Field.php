<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;

    protected $table = 'fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forms_id',
        'name',
        'label',
        'field_type',
        'value_type',
        'value_length',
    ];

    /**
     * @return HasOne
     */
    public function form(): HasOne
    {
        return $this->hasOne(Form::class, 'id', 'forms_id');
    }

    /**
     * @return HasMany
     */
    public function fieldsYears(): HasMany
    {
        return $this->hasMany(FieldYear::class, 'fields_id', 'id');
    }
}
