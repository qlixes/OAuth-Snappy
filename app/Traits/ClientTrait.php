<?php

namespace App\Traits;

use App\Models\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
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
