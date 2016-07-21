<?php

namespace maxvishnja\Tickets;

use Illuminate\Support\ServiceProvider;

class TicketsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/Http/routes.php';
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Tickets');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'Tickets');
        //$this->publishes([__DIR__ . '/database/' => base_path("database")], 'database');

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