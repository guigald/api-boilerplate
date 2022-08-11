<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailField extends Model
{
    use SoftDeletes;

    protected $table = 'detail_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'field_type',
        'value_type',
        'value_length',
    ];

    /**
     * @return HasMany
     */
    public function requestTypes(): HasMany
    {
        return $this->hasMany(RequestTypeDetailField::class, 'detail_fields_id', 'id');
    }
}
