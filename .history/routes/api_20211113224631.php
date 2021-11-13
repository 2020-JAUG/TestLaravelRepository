<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/find/user/name', [UserController::class, 'showByName']);
Route::post('/find/user/email', [UserController::class, 'showByEmail']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::group(['prefix' => 'customer'], function()
{
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/show/{id}', [CustomerController::class, 'show']);
    Route::post('/findByName', [CustomerController::class, 'showByName']);
    Route::post('/findByUser', [CustomerController::class, 'showByUser']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::put('/update/{id}', [CustomerController::class, 'update']);
    Route::delete('/delete/{id}', [CustomerController::class, 'destroy']);
});