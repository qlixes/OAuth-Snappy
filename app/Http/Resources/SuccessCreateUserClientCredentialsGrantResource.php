<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class SuccessCreateUserClientCredentialsGrantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "success" => true,
            "data" => [
                "client_id" => $this->id,
                "client_secret" => Crypt::decryptString($this->phrase),
                "name" => $this->name,
                "grant_types" => $this->grant_types,
                "redirect_uris" => $this->redirect_uris,
                "callback_uris" => $this->callback_uris,
            ],
        ];
    }
}
