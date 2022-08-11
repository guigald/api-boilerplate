<?php

namespace App\Base\Helpers;

class CurrencyHelper
{
    /**
     * @param float $value
     * @return int
     */
    public static function toInteger(float $value): int
    {
        return intval($value * 100);
    }

    /**
     * @param int $value
     * @return float
     */
    public static function toFloat(int $value): float
    {
        return floatval($value / 100);
    }

    /**
     * @param int $value
     * @return string
     */
    public static function toFloatString(int $value): string
    {
        return number_format(floatval($value / 100), 2, '.', '');
    }

    public static function moneyFormat(
        float $value,
        string $prefix = null
    ): string {
        $formattedValue = number_format($value, 2, ',', '.');

        return trim($prefix . ' ' . $formattedValue);
    }
}
