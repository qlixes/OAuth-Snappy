<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Token;

class AccessToken extends Token
{
    protected $table = "oauth_access_tokens";

    protected $guarded = [];
}
