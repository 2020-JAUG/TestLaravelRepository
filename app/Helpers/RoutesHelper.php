<?php

namespace App\Helpers;

use Illuminate\Routing\Router;

final class RoutesHelper
{
    public static function registerApiRoutes(Router $router, string $controllerName, array $methods = ['index', 'show', 'store', 'update', 'delete'])
    {
        if(in_array('index', $methods))
        {
            $router->get('/', sprintf('%s@index', $controllerName))->name('index');
        }
        if(in_array('show', $methods))
        {
            $router->get('/{id}', sprintf('%s@show', $controllerName))->name('show');
        }
        if(in_array('store', $methods))
        {
            $router->post('/', sprintf('%s@store', $controllerName))->name('store');
        }
        if(in_array('update', $methods))
        {
            $router->put('/{id}', sprintf('%s@update', $controllerName))->name('update');
        }
        if(in_array('delete', $methods))
        {
            $router->delete('/{id}', sprintf('%s@destroy', $controllerName))->name('delete');
        }
    }
}