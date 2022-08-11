<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailingQueue extends Model
{
    use SoftDeletes;

    protected $table = 'mailing_queues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'view',
        'function',
        'email_to',
        'name_to',
        'data',
        'sent',
    ];

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(MailingLog::class, 'mailing_queues_id', 'id');
    }
}
