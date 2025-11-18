<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait ClientTrait
{
    use CommonTrait;

    /**
     * Create Client Secret and Hashed
     *
     * @return void
     */
    function createClientSecret()
    {
        return $this->getUniqId(64);
    }

    function createClientId()
    {
        return sprintf("CID_%s", Str::ulid());
    }
}
