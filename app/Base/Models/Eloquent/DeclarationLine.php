<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclarationLine extends Model
{
    use SoftDeletes;

    protected $table = 'declaration_lines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year',
        'prefix',
        'type', // Possible Values -> complete | simplified | departure | all
        'description',
    ];

    /**
     * @return HasMany
     */
    public function columns(): HasMany
    {
        return $this->hasMany(DeclarationColumn::class, 'declaration_lines_id', 'id');
    }
}
