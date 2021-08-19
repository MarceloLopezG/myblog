<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

/**
 * Routes for signup & login
 *
 */

Route::group([
    'prefix' => 'users'
], function () {
    //Public access routes
    Route::post('signup', [UserController::class, 'user_create']);
    Route::post('login', [UserController::class, 'login']);
    //

    // Access only for logged in users
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::put('user-update/{id}', [UserController::class, 'user_update']);
        Route::delete('user-delete/{id}', [UserController::class, 'user_delete']);
        Route::get('index', [UserController::class, 'user_index']);
        Route::post('logout', [UserController::class, 'logout']);
    });
});