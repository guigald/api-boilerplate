<?php

namespace App\Base\Helpers;

use App\Base\Exceptions\CreateException;
use App\Base\Models\Eloquent\MailingQueue;
use App\Base\Models\Eloquent\Notification;
use App\Mailing\Repositories\MailingQueueRepository;
use App\Notification\Repositories\NotificationRepository;
use App\Notification\Services\CreateNotificationService;

class NotificationHelper
{
    /**
     * @param string $type
     * @param int|null $userId
     * @param array|null $emailData
     * @return bool
     * @throws CreateException
     */
    public static function setNotification(
        string $type,
        ?int $userId,
        ?array $emailData
    ): bool {
        // TODO: Make it as a http request
        $createNotificationService = new CreateNotificationService(
            new NotificationRepository(new Notification()),
            new MailingQueueRepository(new MailingQueue())
        );

        $createNotificationService
            ->createNotification($type, $userId, $emailData);

        return true;
    }
}
