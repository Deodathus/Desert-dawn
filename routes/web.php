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

    /**
     * Admin routes
     */
    Route::middleware('admin')
        ->namespace('Admin')
        ->prefix('admin')
        ->name('admin.')->group(function (): void {
            Route::get('/', 'AdminController@index')->name('home');

            /**
             * User
             */
            Route::resource('users', 'User\AdminUserManageController');
            Route::get('login/{user}', 'User\AdminUserManageController@loginAsUser')->name('login.as.user');

            /**
             * Manage all users
             */
            Route::get('manage-all/users', 'User\AdminUserManageController@manageAllIndex')->name('manage.all.users.index');
            Route::post('manage-all/users', 'User\AdminUserManageController@addCurrenciesToAllUsers')->name('manage.all.users.add.currencies');

            /**
             * Boss
             */
            Route::resource('bosses', 'Boss\AdminBossManageController');

            /**
             * Item
             */
            Route::resource('items', 'Item\AdminItemManageController');
    });

    Route::middleware('auth')->group(function (): void
    {
        /**
         * Home route
         */
        Route::get('/home', 'HomeController@index')->name('home');

        /**
         * User routes
         */
        Route::name('user.')
            ->namespace('User\\')
            ->group(function (): void
        {
            Route::get('/', 'UserCharacteristicsController@index')->name('hero');
            Route::get('/update-user-bar', 'UserCharacteristicsController@updateUserBar')->name('update.user.bar');
        });

        /**
         * Boss routes
         */
        Route::middleware('item.reward.check')
            ->namespace('Boss\\')
            ->name('boss.')
            ->group(function (): void
        {
            Route::get('/boss', 'BossController@index')->name('index')->middleware('hp.check');
            Route::get('/boss/{boss}', 'BossController@show')->name('show')->middleware('boss.check');
        });

        /**
         * Attack routes
         */
        Route::middleware('item.reward.check')
            ->name('attack.')
            ->namespace('Boss\\')
            ->group(function (): void
        {
            Route::get('/boss/{boss}/firstSkill', 'BossController@firstSkill')->name('first');
            Route::get('/boss/{boss}/secondSkill', 'BossController@secondSkill')->name('second');
            Route::get('/boss/{boss}/thirdSkill', 'BossController@thirdSkill')->name('third');
        });

        /**
         * Level-up routes
         */
        Route::view('/levelup', 'popup.levelup')->name('lvlup');

        /**
         * Item routes
         */
        Route::name('item.')
            ->namespace('Item\\')
            ->group(function (): void
        {
            Route::patch('/update-activity-status/{item}', 'ItemController@updateCardActiveStatus')->name('change.status');
            Route::get('/item-reward', 'ItemController@getRewardItem')->name('reward');
        });

        /**
         * Shop routes
         */
        Route::name('shop.')
            ->namespace('Shop\\')
            ->group(function (): void
        {
            Route::get('/shop', 'ShopController@index')->name('index');
            Route::get('/shop/getType', 'ShopController@getType')->name('get.type');
            Route::get('/shop/sell/{item}', 'ShopController@sell')->name('sell');
            Route::get('/shop/buy/first', 'ShopController@buyFirstSkill')->name('buy.default.skill.1');
            Route::get('/shop/buy/second', 'ShopController@buySecondSkill')->name('buy.default.skill.2');
            Route::get('/shop/buy/third', 'ShopController@buyThirdSkill')->name('buy.default.skill.3');
        });

        /**
         * Quest routes.
         */
        Route::name('quest.')
            ->namespace('Quest\\')
            ->group(function (): void
        {
            Route::get('/quests', 'QuestController@index')->name('index');
            Route::get('/quest/{quest}', 'QuestController@show')->name('show');
            Route::get('/{quest}/reward', 'QuestController@getQuestReward')->name('get.reward');
        });

        /**
         * Mission routes.
         */
        Route::name('mission.')
            ->namespace('Quest\\')
            ->group(function (): void
        {
            Route::get('/quests/{quest}/missions', 'MissionController@index')->name('index');
            Route::get('/quest/{mission}/done', 'MissionController@doneMission')->name('done');
        });
    });
