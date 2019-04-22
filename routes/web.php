<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', 'BossController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

    Route::middleware('auth')->group(function ()
    {
        Route::name('boss.')->group(function ()
        {
            Route::get('/boss', 'BossController@index')->name('index')->middleware('hp.check');
            Route::get('/boss/{boss}', 'BossController@show')->name('show')->middleware('boss.check');
        });

        Route::name('attack.')->group(function ()
        {
            Route::get('/boss/{boss}/first', 'BossController@firstSkill')->name('first');
        });

    });