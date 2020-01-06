<?php

use Illuminate\Http\Request;

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

Route::middleware('api')
    ->namespace('API\\')
    ->name('API.')
    ->group(function (): void {
        /**
         * User API routes.
         */
        Route::post('user/get', 'User\APIUserController@getUser')->name('user.get');
});
