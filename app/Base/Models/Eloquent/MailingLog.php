<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailingLog extends Model
{
    use SoftDeletes;

    protected $table = 'mailing_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailing_queues_id',
        'mailing_log_types_id',
        'message',
    ];

    /**
     * @return HasOne
     */
    public function queue(): HasOne
    {
        return $this->HasOne(MailingQueue::class, 'id', 'mailing_queues_id');
    }

    /**
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(MailingLogType::class, 'id', 'mailing_log_types_id');
    }
}
