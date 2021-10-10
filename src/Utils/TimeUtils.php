<?php

namespace App\Utils;

use DateTime;

class TimeUtils
{
    const SECOND = 1,
        MINUTE = self::SECOND * 60,
        HOUR = self::MINUTE * 60,
        DAY = self::HOUR * 24;

    public static function getCountdownValues(DateTime $dateTime): array
    {
        $distance = $dateTime->getTimestamp() - (new DateTime('now'))->getTimestamp();
        $days = floor($distance / (self::DAY)) . " j";
        $hours = floor(($distance % (self::DAY)) / (self::HOUR)) . " h";
        $minutes = floor(($distance % (self::HOUR)) / (self::MINUTE)) . " min";
        $seconds = floor(($distance % (self::MINUTE)) / self::SECOND) . " s";
        return [$days, $hours, $minutes, $seconds];
    }
}