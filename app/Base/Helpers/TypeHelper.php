<?php

namespace App\Base\Helpers;

class TypeHelper
{
    /**
     * @param string $value
     * @return string
     */
    public static function text(string $value): string
    {
        return trim($value);
    }

    /**
     * @param string $value
     * @param int $decimal
     * @return float
     */
    public static function number(string $value, int $decimal): float
    {
        $number = number_format(floatval(trim($value)), $decimal, '.', '');

        $divider = self::getFactor($decimal);
        $number = $number / $divider;

        return floatval($number);
    }

    /**
     * @param string $value
     * @param string $format
     * @param int $decimal
     * @return string
     */
    public static function getRawValue(
        string $value,
        string $format,
        int $decimal
    ): string {
        if ($format === 'text' || $format === 'boolean') {
            return $value;
        }

        $multiplier = self::getFactor($decimal);
        $number = floatval($value) * $multiplier;

        return number_format($number, 0, '.', '');
    }

    /**
     * @param int $decimal
     * @return int
     */
    private static function getFactor(int $decimal): int
    {
        $factor = 1;

        for ($i = 0; $i < $decimal; $i++) {
            $factor = $factor * 10;
        }

        return $factor;
    }
}
