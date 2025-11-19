<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class UserProfileResource extends JsonResource
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
            "message" => "Successfully load profile",
            "data" => [
                "name" => $this->users->name,
                "email" => $this->users->email,
                "channel_id" => $this->users->channel_id,
                "client_id" => $this->clients->id,
                "client_secret" => Crypt::decryptString($this->clients->phrase),
            ],
        ];
    }
}
