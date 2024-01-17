<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Pusher\Pusher;

class PusherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('pusher', function ($app) {
            $config = $app['config']['broadcasting.connections.pusher'];

            return new Pusher(
                $config['key'],
                $config['secret'],
                $config['app_id'],
                $config['options']
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
