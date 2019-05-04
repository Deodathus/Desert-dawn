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

Auth::routes();

    Route::middleware('auth')->group(function ()
    {
        Route::get('/home', 'HomeController@index')->name('home');

        Route::name('user.')->group(function ()
        {
            Route::get('/', 'UserCharacteristicsController@index')->name('hero');
        });

        Route::name('boss.')->group(function ()
        {
            Route::get('/boss', 'BossController@index')->name('index')->middleware('hp.check');
            Route::get('/boss/{boss}', 'BossController@show')->name('show')->middleware('boss.check');
        });

        Route::name('attack.')->group(function ()
        {
            Route::get('/boss/{boss}/firstSkill', 'BossController@firstSkill')->name('first');
            Route::get('/boss/{boss}/secondSkill', 'BossController@secondSkill')->name('second');
            Route::get('/boss/{boss}/thirdSkill', 'BossController@thirdSkill')->name('third');
        });

        Route::view('/levelup', 'levelup')->name('lvlup');
    });