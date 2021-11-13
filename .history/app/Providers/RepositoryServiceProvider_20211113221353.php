<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Add UserRepository
        $this->app->bind(
            'App\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepositoryImpl'
        );

        //Add CustomerRepository
        $this->app->bind(
            'App\Interfaces\CustomerRepositoryInterface',
            'App\Repositories\CustomerRepositoryImpl'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}