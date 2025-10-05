<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SimpleLogger
{
    public function log($message)
    {
        Log::info("SimpleLogger: " . $message);
        return "Logged: " . $message;
    }
}
