<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedingType extends Model
{
    use SoftDeletes;

    protected $table = 'feeding_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'label',
    ];

    public function feedings(): HasMany
    {
        return $this->hasMany(Feeding::class, 'feeding_types_id', 'id');
    }
}
