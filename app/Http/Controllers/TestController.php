<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SimpleLogger;

class TestController extends Controller
{
    public function __construct(public SimpleLogger $simpleLogger)
    {

    }

    public function index()
    {
        $message = $this->simpleLogger->log('User accessed this test page');
        dump($message);
    }
}
