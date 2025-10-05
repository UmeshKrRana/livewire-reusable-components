<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Greeting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'greeting';
    }
}
