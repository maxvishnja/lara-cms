<?php

namespace Impalago\TasksManager;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\ServiceProvider;

class TasksManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/tasks.php', 'tasks');
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'tasks');

        $this->publishes([
            __DIR__ . '/lang' => resource_path('lang/vendor/tasks'),
            __DIR__ . '/views' => resource_path('views/vendor/tasks'),
            __DIR__ . '/config/tasks.php' => config_path('tasks.php'),
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ]);

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/views', 'tasks');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}