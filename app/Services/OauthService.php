<?php

namespace App\Services;

use Laravel\Passport\Http\Controllers\ConvertsPsrResponses;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class OauthService
{
    use ConvertsPsrResponses, HandlesOAuthErrors;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected AuthorizationServer $server,
    ) {}

    /**
     * Issue an access token.
     */
    public function issueToken(ServerRequestInterface $psrRequest, ResponseInterface $psrResponse)
    {
        return $this->server->respondToAccessTokenRequest($psrRequest, $psrResponse);
    }
}
