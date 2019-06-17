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
        /**
         * Home route
         */
        Route::get('/home', 'HomeController@index')->name('home');

        /**
         * User routes
         */
        Route::name('user.')->group(function ()
        {
            Route::get('/', 'UserCharacteristicsController@index')->name('hero');
        });

        /**
         * Boss routes
         */
        Route::middleware('item.reward.check')->group(function ()
        {
            Route::name('boss.')->group(function ()
            {
                Route::get('/boss', 'BossController@index')->name('index')->middleware('hp.check');
                Route::get('/boss/{boss}', 'BossController@show')->name('show')->middleware('boss.check');
            });
        });

        /**
         * Attack routes
         */
        Route::middleware('item.reward.check')->group(function ()
        {
            Route::name('attack.')->group(function ()
            {
                Route::get('/boss/{boss}/firstSkill', 'BossController@firstSkill')->name('first');
                Route::get('/boss/{boss}/secondSkill', 'BossController@secondSkill')->name('second');
                Route::get('/boss/{boss}/thirdSkill', 'BossController@thirdSkill')->name('third');
            });
        });

        /**
         * Level-up routes
         */
        Route::view('/levelup', 'popup.levelup')->name('lvlup');

        /**
         * Item routes
         */
        Route::name('item.')->group(function ()
        {
            Route::patch('/update-activity-status/{item}', 'ItemController@updateCardActiveStatus')->name('change.status');
            Route::get('/item-reward', 'ItemController@getRewardItem')->name('reward');
        });

        Route::name('shop.')->group(function ()
        {
            Route::get('/shop', 'ShopController@index')->name('index');
            Route::get('/shop/buy/first', 'ShopController@buyFirstSkill')->name('buy::default.skill.1');
            Route::get('/shop/buy/second', 'ShopController@buySecondSkill')->name('buy::default.skill.2');
            Route::get('/shop/buy/third', 'ShopController@buyThirdSkill')->name('buy::default.skill.3');
        });

        Route::name('quest.')->group(function ()
        {
            Route::get('/quests', 'QuestController@index')->name('index');
        });

        Route::name('mission.')->group(function ()
        {
            Route::get('/quests/{quest}/missions', 'MissionController@index')->name('index');
        });
    });