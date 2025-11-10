<?php

namespace App\Providers;

use App\Models\AccessToken;
use App\Models\Client;
use App\Models\RefreshToken;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(CarbonInterval::minutes(15));
        Passport::refreshTokensExpireIn(CarbonInterval::hours(1));
        Passport::personalAccessTokensExpireIn(CarbonInterval::days(1));

        Passport::useClientModel(Client::class);
        Passport::useTokenModel(AccessToken::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
    }
}
