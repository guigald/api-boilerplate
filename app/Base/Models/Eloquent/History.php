<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;

    public const SPECIALIST = 1;
    public const CLIENT = 2;

    protected $table = 'histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requests_id',
        'senders_id',
        'message',
        'send_date',
        'read_date',
    ];

    /**
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class, 'requests_id', 'id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'histories_id', 'id');
    }
}
