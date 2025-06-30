<?php

namespace Orian\Framework\Providers;

use Orian\Framework\Helper\Helper;
use Orian\Framework\Constant\Constant;
use Illuminate\Support\ServiceProvider;

class OrianHelperServiceProvider extends ServiceProvider
{
    /**
    * Register any application services.
    */
    public function register(): void
    {
        $this->app->singleton('orian-helper-functions', function ($app) {
            return new Helper();
        });
        $this->app->singleton('orian-constant-functions', function ($app) {
            return new Constant();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
