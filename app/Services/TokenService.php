<?php

namespace App\Services;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use App\Repositories\AccessTokenRepository;

class TokenService
{
    protected Configuration $jwtConfiguration;

    function __construct(
        protected AccessTokenRepository $token
    ) {
        $this->jwtConfiguration = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::file(storage_path("oauth-private.key")),
            InMemory::file(storage_path("oauth-public.key"))
        );
    }

    function verify(string $bearerToken)
    {
        $token = $this->jwtConfiguration->parser()->parse($bearerToken);

        $tokenId = $token->claims()->get("jti");

        $accessToken = $this->token->find($tokenId);

        $verify = (!$accessToken || $accessToken->revoked || $accessToken->expires_at->isPast());

        return [$verify, $accessToken];
    }
}
