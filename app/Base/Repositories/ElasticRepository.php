<?php

declare(strict_types=1);

namespace App\Base\Repositories;

use App\Base\Connections\ElasticSearchConnection;
use App\Base\Helpers\DateHelper;

class ElasticRepository extends ElasticSearchConnection
{
    private const SEARCH_TYPE = [
        'match' => 'match',
        'prefix' => 'match_phrase_prefix',
    ];

    /**
     * @param string $indexName
     * @param array $properties
     * @param int $shards
     * @param int $replicas
     */
    public function createIndex(
        string $indexName,
        array $properties = [],
        int $shards = 3,
        int $replicas = 2
    ): void {
        $params = [
            'index' => $indexName,
            'body' => [
                'settings' => [
                    'number_of_shards' => $shards,
                    'number_of_replicas' => $replicas,
                ],
            ]
        ];

        if (!empty($properties)) {
            $params['body']['mappings'] = [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => $properties
            ];
        }

        if (!$this->indexExists($indexName)) {
            $this->client->indices()->create($params);
        }
    }

    /**
     * @param string $indexName
     */
    public function deleteIndex(string $indexName)
    {
        $params = [
            'index' => $indexName,
        ];

        if (!$this->indexExists($indexName)) {
            $this->client->indices()->delete($params);
        }
    }

    /**
     * @param array $data
     * @param string $type
     * @param string $index
     */
    public function insert(
        array $data,
        string $type = 'log',
        string $index = 'logs'
    ): void {
//        $params = [
//            'index' => $index,
//            'id' => md5(uniqId(data_get($data, 'date', DateHelper::now()))),
//            'type' => $type,
//            'body' => $data,
//        ];
//
//        $this->client->index($params);
    }

    /**
     * @param array $searchData
     * @param string $type
     * @param string $index
     * @param string $searchType
     * @return array
     */
    public function search(
        array $searchData,
        string $type = 'log',
        string $index = 'logs',
        string $searchType = 'match'
    ): array {
        $params = [
            'index' => $index,
            'type' => $type,
        ];

        if (!empty($searchData)) {
            $searchType = self::SEARCH_TYPE[$searchType];
            data_set($params, 'body.query.' . $searchType, $searchData);
        }

        return $this->client->search($params);
    }

    /**
     * @param string $indexName
     * @return bool
     */
    private function indexExists(string $indexName): bool
    {
        $params = [
            'index' => $indexName,
        ];

        return !!$this->client->indices()->exists($params);
    }
}
