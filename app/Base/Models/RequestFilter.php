<?php

declare(strict_types=1);

namespace App\Base\Models;

class RequestFilter
{
    public const FIELD = [
        'date' => [
            'field' => 'requests.created_at',
            'operator' => '=',
        ],
        'from_date' => [
            'field' => 'requests.created_at',
            'operator' => '>=',
            'complement' => ' 00:00:00',
        ],
        'to_date' => [
            'field' => 'requests.created_at',
            'operator' => '<=',
            'complement' => ' 23:59:59',
        ],
        'document' => [
            'field' => 'users.document',
            'operator' => '=',
        ],
        'status' => [
            'field' => 'request_backoffice_status.name',
            'operator' => '=',
        ],
        'name' => [
            'field' => 'users.name',
            'operator' => 'like',
            'complement' => '%',
        ],
        'user' => [
            'field' => 'requests.users_id',
            'operator' => '=',
        ],
        'specialist' => [
            'field' => 'requests.specialists_id',
            'operator' => '=',
        ],
    ];
}
