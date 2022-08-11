<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailingLogType extends Model
{
    use SoftDeletes;

    protected $table = 'mailing_log_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(MailingLog::class, 'mailing_log_types_id', 'id');
    }
}
