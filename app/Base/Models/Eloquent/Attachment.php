<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;

    protected $table = 'attachments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'histories_id',
        'path',
    ];

    /**
     * @return BelongsTo
     */
    public function histories(): BelongsTo
    {
        return $this->belongsTo(History::class, 'id', 'histories_id');
    }
}
