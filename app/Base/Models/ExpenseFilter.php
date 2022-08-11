<?php

declare(strict_types=1);

namespace App\Base\Models;

class ExpenseFilter
{
    public const FIELD = [
        'category' => [
            'field' => 'expenses.category',
            'operator' => '=',
        ],
        'dependent_id' => [
            'field' => 'expenses.dependents_id',
            'operator' => '=',
        ],
        'related_to' => [
            'field' => 'expenses.related_to',
            'operator' => '=',
        ],
    ];
}
