<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    protected $table = "oauth_refresh_tokens";

    protected $guarded = [];
}
