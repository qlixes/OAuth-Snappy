<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class UserCreatedResource extends JsonResource
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
            "message" => "Successfully create",
            "data" => [
                "email" => $this->email,
                "name" => $this->name,
                "clients" => [
                    "client_id" => $this->clients->id,
                    "client_secret" => Crypt::decryptString($this->clients->phrase),
                    "grant_types" => $this->clients->grant_types,
                ],
            ],
        ];
    }
}
