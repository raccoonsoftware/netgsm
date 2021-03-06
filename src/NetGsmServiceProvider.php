<?php

namespace RaccoonSoftware\NetGsm;

use Illuminate\Support\ServiceProvider;

class NetGsmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Language
        $this->loadTranslationsFrom( __DIR__.'/Lang', 'netgsm');

        $this->publishes([
            __DIR__.'/Config/netgsm.php' => config_path('netgsm.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // Config
        $this->mergeConfigFrom( __DIR__.'/Config/netgsm.php', 'netgsm');

        $this->app['netgsm'] = $this->app->share(function($app) {
            return new NetGsm;
        });
    }
}
