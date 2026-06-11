<?php

namespace Orian\Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Orian\Framework\Console\Commands\OriansInstallCommand;
use Orian\Framework\Console\Commands\OriansManifestCommand;
use Orian\Framework\Console\Commands\OriansSyncCommand;
use Orian\Framework\Helper\Helper;
use Orian\Framework\Services\ICO\ICO;
use Orian\Framework\Support\Manifest;

class OrianServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('orians-helpers', function ($app) {
            return new Helper();
        });
        $this->app->singleton('orians-ico', function ($app) {
            return new ICO();
        });
        $this->mergeConfigFrom(__DIR__ . '/../config/orian.php', 'orian');
        $this->mergeConfigFrom(__DIR__ . '/../config/core.php', 'core');

        $this->app->singleton(Manifest::class, function () {
            return new Manifest(config('orians.manifest'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadFunctions();
        $this->loadConfig();
        $this->loadViews();
        $this->loadCommands();
    }

    protected function loadFunctions()
    {
        foreach (glob(__DIR__ . '/../Helper/Functions.php') as $filename) {
            require_once $filename;
        }
    }
    protected function loadConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/orian.php' => config_path('orian.php'),
        ], 'orian');
        $this->publishes([
            __DIR__ . '/../config/core.php' => config_path('core.php'),
        ], 'core');
    }
    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'orians');
    }
    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                OriansInstallCommand::class,
                OriansManifestCommand::class,
                OriansSyncCommand::class,
            ]);
        }
    }
}
