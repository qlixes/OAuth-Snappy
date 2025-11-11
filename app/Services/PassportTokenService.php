<?php

namespace App\Services;

use Laravel\Passport\Http\Controllers\AccessTokenController;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class PassportTokenService
{
    function issueToken(array $attributes)
    {
        //
    }
}
