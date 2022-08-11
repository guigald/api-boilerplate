<?php

namespace App\Base\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * @param string|null $fragment
     * @return string
     */
    public static function now(?string $fragment = null): string
    {
        if (!empty($fragment)) {
            return (string) Carbon::now()->timezone(env('TIMEZONE'))->$fragment;
        }

        return Carbon::now()->timezone(env('TIMEZONE'))->toDateTimeString();
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $type
     * @return int
     */
    public static function getDiffTimeIn(
        string $startDate,
        string $endDate,
        string $type = 'minutes'
    ): int {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        return self::$type($startDate, $endDate);
    }

    /**
     * @param string $fromDate
     * @param int $days
     * @return string
     */
    public static function getDateByDiffDays(
        string $fromDate,
        int $days
    ): string {
        return Carbon::parse($fromDate)
            ->subDays($days * -1)
            ->toDateTimeString();
    }

    /**
     * @param string $fromDate
     * @param int $minutes
     * @return string
     */
    public static function getDateByDiffMinutes(
        string $fromDate,
        int $minutes
    ): string {
        return Carbon::parse($fromDate)
            ->subMinutes($minutes * -1)
            ->toDateTimeString();
    }

    /**
     * @param string $date
     * @param string|null $from
     * @param string|null $to
     * @return bool
     */
    public static function isBetweenDates(
        string $date,
        ?string $from,
        ?string $to
    ): bool {
        if ($from === null && $to === null) {
            return true;
        }

        if (!empty($from) && $date < $from) {
            return false;
        }

        if (!empty($to) && $date > $to) {
            return false;
        }

        return true;
    }

    /**
     * @param mixed $date (YYYY-mm-dd) || (YYYY-mm-dd HH:ii:ss)
     * @param string $fragment
     * @return string
     */
    public static function getDateFragment(
        mixed $date,
        string $fragment
    ): string {
        $dateObject = Carbon::parse($date);

        return $dateObject->get($fragment);
    }

    /**
     * @param string $date (yyyy-mm-dd)
     * @param int $value
     * @param string $fragment
     * @return string
     */
    public static function putFragment(
        string $date,
        int $value,
        string $fragment
    ): string {
        list($year, $month, $day) = explode('-', $date);

        $$fragment = ($value < 10) ? '0' . $value : $value;

        return implode('-', [$year, $month, $day]);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    private static function years(Carbon $startDate, Carbon $endDate): int
    {
        return $endDate->diffInYears($startDate);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    private static function months(Carbon $startDate, Carbon $endDate): int
    {
        return $endDate->diffInMonths($startDate);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    private static function days(Carbon $startDate, Carbon $endDate): int
    {
        return $endDate->diffInDays($startDate);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    private static function hours(Carbon $startDate, Carbon $endDate): int
    {
        return $endDate->diffInHours($startDate);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    private static function minutes(Carbon $startDate, Carbon $endDate): int
    {
        return $endDate->diffInMinutes($startDate);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int
     */
    private static function seconds(Carbon $startDate, Carbon $endDate): int
    {
        return $endDate->diffInSeconds($startDate);
    }
}
