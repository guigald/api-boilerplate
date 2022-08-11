<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    public const TYPE = [
        'legacy-opinion' => 1,
        'legacy-message' => 2,
        'legacy-status' => 3,
    ];

    public const MESSAGE = [
        'legacy-opinion.specialist' => 'notifications.legacy.opinion.specialist',
        'legacy-opinion.user' => 'notifications.legacy.opinion.user',
        'legacy-message.specialist' => 'notifications.legacy.message',
        'legacy-message.user' => 'notifications.legacy.message',
        'legacy-status.new' => 'notifications.legacy.status.new',
        'legacy-status.ongoing' => 'notifications.legacy.status.ongoing',
        'legacy-status.return' => 'notifications.legacy.status.return',
        'legacy-status.transmitted' => 'notifications.legacy.status.transmitted',
    ];

    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_types_id',
        'users_id',
        'message',
        'read_at',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * @return HasOne
     */
    public function notificationType(): HasOne
    {
        return $this->hasOne(NotificationType::class, 'id', 'notification_types_id');
    }
}
