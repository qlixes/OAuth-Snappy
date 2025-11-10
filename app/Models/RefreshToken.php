<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\RefreshToken as PassportRefreshToken;

class RefreshToken extends PassportRefreshToken
{
    protected $table = "oauth_refresh_tokens";

    protected $guarded = [];
}
