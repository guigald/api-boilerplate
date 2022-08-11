<?php

namespace App\Base\Helpers;

use App\Base\Exceptions\CreateException;
use App\Base\Models\Eloquent\MailingQueue;
use App\Base\Models\Eloquent\Notification;
use App\Base\Repositories\ElasticRepository;
use App\Mailing\Repositories\MailingQueueRepository;
use App\Notification\Repositories\NotificationRepository;
use App\Notification\Services\CreateNotificationService;

class ElasticHelper
{
    const MESSAGES = [
        'declaration' => [
            'expense' => [
                'create' => 'Uma despesa foi criada',
                'update' => 'Uma despesa foi atualizada',
                'delete' => 'Uma despesa foi deletada',
            ],
        ],
    ];

    /**
     * @param string $category
     * @param array $body
     */
    public static function log(
        string $category,
        array $body = []
    ): void {
        $categoryArray = explode('.', $category);

        data_set($body, 'message', $category);
        data_set($body, 'users_id', auth('api')->id() ?? null);
        data_set($body, 'category', current($categoryArray));
        data_set($body, 'subcategory', next($categoryArray));
        data_set($body, 'action', next($categoryArray));
        data_set($body, 'created_at', DateHelper::now());

        // TODO: Make it as a http request
        $elasticRepository = new ElasticRepository();
        $elasticRepository->insert($body);
    }

    /**
     * @param array $body
     */
    public static function saveDocument(
        array $body = []
    ): void {
        // TODO: Make it as a http request
        $elasticRepository = new ElasticRepository();
        $elasticRepository->insert($body, 'document', 'documents');
    }

    /**
     * @param array $searchData
     * @param string $type
     * @param string $index
     * @param string $searchType
     * @return array
     */
    public static function search(
        array $searchData,
        string $type = 'log',
        string $index = 'logs',
        string $searchType = 'match'
    ): array {
        // TODO: Make it as a http request
        $elasticRepository = new ElasticRepository();
        $result = $elasticRepository->search(
            $searchData,
            $type,
            $index,
            $searchType
        );

        return data_get($result, 'hits.hits');
    }
}
