<?php

use App\Helpers\RoutesHelper;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'user'],function(Router $router)
{
    RoutesHelper::registerApiRoutes($router, 'App\Http\Controllers\UserController');
});