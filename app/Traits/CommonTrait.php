<?php

namespace App\Traits;

trait CommonTrait
{
    function getUniqId(int $length = 25)
    {
        $bytes = random_bytes($length);
        $uniqid = bin2hex($bytes);

        return $uniqid;
    }
}
