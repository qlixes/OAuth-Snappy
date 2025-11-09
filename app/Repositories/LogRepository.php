<?php

namespace App\Repositories;

use App\Models\Log;

class LogRepository
{
    function __construct(
        protected Log $log
    ) {}

    function create(array $attributes)
    {
        return $this->log->create($attributes);
    }

    function find(array $attributes)
    {
        return $this->log->where($attributes)->first();
    }

    function filter(array $attributes)
    {
        return $this->log->where($attributes)->get();
    }

    function update(array $condition, array $attributes)
    {
        return $this->log->where($condition)->update($attributes);
    }

    function delete(int $id)
    {
        return $this->log->delete($id);
    }
}
