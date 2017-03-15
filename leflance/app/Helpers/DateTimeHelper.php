<?php

namespace App\Helpers;

use Carbon\Carbon;
use Jenssegers\Date\Date;

class DateTimeHelper
{
    const FORMAT_HUMAN = 'j F Y';

    /**
     * DateTimeHelper constructor.
     */
    public function __construct()
    {
        Date::setLocale(config('app.locale'));
    }

    /**
     * @param $date
     * @param null $format
     * @return string
     */
    public static function parseDate($date, $format = null)
    {
        $formats = ['j F Y', 'd.m.Y', 'Y-m-d H:i:s'];

        if (!is_null($format)) {
            array_unshift($formats, $format);
        }

        $formats = array_unique($formats);

        foreach ($formats as $format) {
            try {
                return Date::parse($date)->format($format);
            } catch (\Exception $e) {
                continue;
            }
        }

        return $date;
    }

}