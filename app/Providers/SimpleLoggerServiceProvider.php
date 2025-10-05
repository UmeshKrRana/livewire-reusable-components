<?php

namespace App\Providers;

use App\Services\SimpleLogger;
use Illuminate\Support\ServiceProvider;

class SimpleLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SimpleLogger::class, function($app) {
            return new SimpleLogger();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Log::debug('SimpleLoggerServiceProvider booted');
    }
}
