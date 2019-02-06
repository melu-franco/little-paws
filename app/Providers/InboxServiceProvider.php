<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InboxServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
          $this->publishes([
            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('App\Http\Controllers\InboxController');
        $this->loadViewsFrom(__DIR__.'/views', 'inbox');
    }
}
