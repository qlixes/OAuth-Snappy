<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSigninResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "status" => true,
            "message" => "Successfully signin",
            "data" => [
                "token_type" => $this->tokenType,
                "expire_in" => $this->expiresIn,
                "access_token" => $this->accessToken,
            ],
        ];
    }
}
