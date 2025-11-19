<?php

namespace App\Repositories;

use App\Models\AccessToken;

class AccessTokenRepository
{
    function __construct(
        protected AccessToken $token
    ) {}

    function find(string $tokenId)
    {
        return $this->token->find($tokenId);
    }
}
