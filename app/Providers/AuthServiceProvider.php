<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AccessToken;
use App\Models\Client;
use App\Models\RefreshToken;
use Carbon\CarbonInterval;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Passport::loadKeysFrom(storage_path());

        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(CarbonInterval::minutes(15));
        Passport::refreshTokensExpireIn(CarbonInterval::hours(1));
        Passport::personalAccessTokensExpireIn(CarbonInterval::days(1));

        Passport::useClientModel(Client::class);
        Passport::useTokenModel(AccessToken::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
    }
}
