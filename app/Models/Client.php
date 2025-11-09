<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Laravel\Passport\Client as PassportClient;
use Illuminate\Support\Str;

class Client extends PassportClient
{
    protected $table = "oauth_clients";

    protected $hidden = ["secret"];

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::ulid();
            }

            $model->phrase = Crypt::encryptString($model->plainSecret);
        });
    }

    function supportsGrantType(string $grantType)
    {
        return in_array($grantType, $this->grantTypes);
    }
}
