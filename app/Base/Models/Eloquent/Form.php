<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modules_id',
        'name',
        'label',
    ];

    /**
     * @return HasOne
     */
    public function module(): HasOne
    {
        return $this->hasOne(Module::class, 'modules_id', 'id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class, 'forms_id', 'id');
    }
}
