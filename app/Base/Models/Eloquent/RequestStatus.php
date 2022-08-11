<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestStatus extends Model
{
    use SoftDeletes;

    public const FIRST = [
        'audit' => 1,
        'definitive-departure' => 2,
    ];

    public const SECOND = [
        'audit' => 2,
        'definitive-departure' => 3,
    ];

    public const THIRD = [
        'audit' => 2,
        'definitive-departure' => 4,
    ];

    public const FOURTH = [
        'audit' => 2,
        'definitive-departure' => 5,
    ];

    public const FIFTH = [
        'audit' => 2,
        'definitive-departure' => 6,
    ];

    public const SIXTH = [
        'audit' => 2,
        'definitive-departure' => 7,
    ];

    public const SEVENTH = [
        'audit' => 2,
        'definitive-departure' => 8,
    ];

    public const NEXT_STATUS = [
        3 => self::THIRD,
        6 => self::SIXTH,
        7 => self::SEVENTH,
    ];

    public const STATUS = [
        2 => [
            'user' => 'ongoing-orientation',
            'backoffice' => 'ongoing-orientation',
        ],
        3 => [
            'user' => 'video-guidance-conpleted',
            'backoffice' => 'video-guidance-conpleted',
        ],
        4 => [
            'user' => 'orientation-completed',
            'backoffice' => 'orientation-completed',
        ],
        5 => [
            'user' => 'comunication-in-filling',
            'backoffice' => 'comunication-in-filling',
        ],
        6 => [
            'user' => 'comunication-filled-awaiting-elaboration',
            'backoffice' => 'comunication-filled',
            'notify-specialist' => true,
        ],
        7 => [
            'user' => 'your-comunication-is-in-elabotation',
            'backoffice' => 'comunication-in-elabotation',
        ],
        8 => [
            'user' => 'your-definitive-departure-comunication-is-delivered',
            'backoffice' => 'comunication-delivered',
        ],
    ];

    protected $table = 'request_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_user_status_id',
        'request_backoffice_status_id',
        'order',
    ];

    /**
     * @return HasOne
     */
    public function userStatus(): HasOne
    {
        return $this->hasOne(RequestUserStatus::class, 'id', 'request_user_status_id');
    }

    /**
     * @return HasOne
     */
    public function backofficeStatus(): HasOne
    {
        return $this->hasOne(RequestBackofficeStatus::class, 'id', 'request_backoffice_status_id');
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(RequestStatusLog::class, 'request_status_id', 'id');
    }
}
