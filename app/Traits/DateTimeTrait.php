<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait DateTimeTrait
{
    function getCurrentDateTime(string $format = "Y-m-d H:i:s")
    {
        return Carbon::now()->format($format);
    }

    function getDateTimeDiff(string $askDateTime)
    {
        $formatAskDateTime = Carbon::parse($askDateTime);

        return Carbon::now()->diff($formatAskDateTime);
    }

    function getTimestampDiff(int $askTimestamp)
    {
        return Carbon::now()->diffInSeconds($askTimestamp);
    }
}
