<?php

namespace App\Base\Helpers;

class FilterHelper
{
    /**
     * @param array|null $queryString
     * @param array|null $fields
     * @return array
     */
    public static function getFilter(
        array $queryString = null,
        array $fields = null
    ): array {
        $filters = [];

        foreach ($queryString as $key => $value) {
            if (str_contains('order_by', $key) || str_contains('page', $key)) {
                continue;
            }

            $field = data_get($fields, $key);

            if (!empty($field) && $value !== 'all') {
                data_set($field, 'value', $value);
                $filters = [...$filters, $field];
            }

//            $filter = [
//                'field' => $key,
//                'value' => $value,
//                'operator' => '=',
//            ];
//
//            $filters = [...$filters, $filter];
        }

        return $filters;
    }
}
