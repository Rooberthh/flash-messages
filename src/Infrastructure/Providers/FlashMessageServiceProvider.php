<?php

namespace Rooberthh\FlashMessage\Infrastructure\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rooberthh\FlashMessage\Domain\Services\FlashMessageService;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageServiceContract;

class FlashMessageServiceProvider extends ServiceProvider
{
    public $bindings = [
        FlashMessageServiceContract::class => FlashMessageService::class,
    ];

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../../../resources/views', 'flash-message');
        $this->mergeConfigFrom(__DIR__ . '/../../../config/flash-message.php', 'flash-message');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        Blade::componentNamespace('Rooberthh\\FlashMessage\\Application\\Views\\Components', 'flash-message');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../../../config/flash-message.php' => config_path('flash-message.php'),
                    __DIR__ . '/../../../resources/views' => resource_path('views/vendor/flash-message'),
                ],
                'flash-message-config',
            );

            $method = method_exists($this, 'publishesMigrations') ? 'publishesMigrations' : 'publishes';

            $this->{$method}([
                __DIR__ . '/../Database/Migrations' => $this->app->databasePath('migrations'),
            ], 'flash-message-migrations');
        }
    }
}
