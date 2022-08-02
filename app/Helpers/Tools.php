<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use \DateTime;
use \DateInterval;
use \DatePeriod;

class Tools
{
    public static function IsNullOrEmpty(?string $value): bool
    {
        if (($value == null) || ($value == 'null') || ($value == 'NULL') || (trim($value) == '')) {
            return true;
        } else {
            return false;
        }
    }
}