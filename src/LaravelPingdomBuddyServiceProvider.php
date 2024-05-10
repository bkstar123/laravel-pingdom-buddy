<?php
/**
* LaravelPingdomBuddyServiceProvider
*
* @author: tuanha
* @last-mod: 23-Oct-2021
*/

namespace Bkstar123\PingdomBuddy;

use Illuminate\Support\ServiceProvider;
use Bkstar123\PingdomBuddy\Services\PingdomTest;
use Bkstar123\PingdomBuddy\Services\PingdomCheck;

class LaravelPingdomBuddyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pingdomCheck', function ($app) {
            return new PingdomCheck;
        });
        $this->app->singleton('pingdomTest', function ($app) {
            return new PingdomTest;
        });
        $this->mergeConfigFrom(__DIR__.'/config/bkstar123_laravel_pingdombuddy.php', 'bkstar123_laravel_pingdombuddy');
    }
}
