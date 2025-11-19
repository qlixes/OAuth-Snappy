<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\DeviceCode as PassportDeviceCode;

class DeviceCode extends PassportDeviceCode
{
    protected $guarded = [];
}
