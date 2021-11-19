<?php

use App\Helpers\RoutesHelper;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
});


Route::group(['prefix' => 'user'],function(Router $router)
{
    RoutesHelper::registerApiRoutes($router, 'App\Http\Controllers\UserController');
});

Route::group(['prefix' => 'customer'], function(Router $router)
{
    RoutesHelper::registerApiRoutes($router, 'App\Http\Controllers\CustomerController');
});

Route::group(['prefix' => 'address'], function(Router $router)
{
    RoutesHelper::registerApiRoutes($router, 'App\Http\Controllers\AddressController');
});