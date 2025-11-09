<?php

namespace App\Services;

use App\Repositories\LogRepository;
use Illuminate\Http\Request;

class LogService
{
    function __construct(
        protected LogRepository $log
    ) {}

    function store(Request $request)
    {
        $attributes = [
            "user_id" => $request->user_id,
            "oauth_client_id" => $request->oauth_client_id,
            "payload" => $request->all(),
            "remote_ip" => $request->ip(),
        ];

        $this->log->create($attributes);
    }
}
