<?php

namespace App\Exceptions\Address;

use Exception;
use Illuminate\Support\Facades\Log;

class AddressNotFoundException extends Exception
{
    public function report()
    {
        Log::debug('Address not found');
    }
}