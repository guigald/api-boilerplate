<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestStatusLog extends Model
{
    use SoftDeletes;

    protected $table = 'request_status_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requests_id',
        'request_status_id',
        'users_id',
    ];

    /**
     * @return HasOne
     */
    public function request(): HasOne
    {
        return $this->hasOne(Request::class, 'id', 'requests_id');
    }

    /**
     * @return HasOne
     */
    public function requestStatus(): HasOne
    {
        return $this->hasOne(RequestStatus::class, 'id', 'request_status_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
