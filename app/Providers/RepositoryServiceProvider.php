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
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepositoryImpl'
        );

        //Add CustomerRepository
        $this->app->bind(
            'App\Repositories\Interfaces\CustomerRepositoryInterface',
            'App\Repositories\CustomerRepositoryImpl'
        );

        //Add AddressRepository
        $this->app->bind(
            'App\Repositories\Interfaces\AddressRepositoryInterface',
            'App\Repositories\AddressRepositoryImpl'
        );

        //Add AuthRepository
        $this->app->bind(
            'App\Repositories\Interfaces\AuthRepositoryInterface',
            'App\Repositories\AuthRepositoryImpl'
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
