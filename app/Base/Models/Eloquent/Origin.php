<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Origin extends Model
{
    use SoftDeletes;

    protected $table = 'origins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsTo
     */
    public function histories(): BelongsTo
    {
        return $this->belongsTo(History::class, 'origins_id', 'id');
    }
}
