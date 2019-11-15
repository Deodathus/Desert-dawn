<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindLinks();
        $this->bindNamesForCollapse();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Make global variable for admin sidebar.
     */
    public function bindLinks(): void
    {
        $this->app->bind('links', function (): array {
            return [
                [
                    'name' => '<i v-html="rawHtml" class="fas fa-users"></i> Users',
                    'links' => [
                        [
                            'href' => route('admin.users.index'),
                            'text' => 'Manage',
                        ],
                        [
                            'href' => route('admin.manage.all.users.index'),
                            'text' => 'Manage All',
                        ],
                    ],
                ],
                [
                    'name' => '<i class="fas fa-khanda"></i> Bosses',
                    'links' => [
                        [
                            'href' => route('admin.bosses.index'),
                            'text' => 'Manage',
                        ],
                        [
                            'href' => 'tasd',
                            'text' => 'Bosses',
                        ],
                    ],
                ],
                [
                    'name' => '<i class="fas fa-chess-knight"></i> Items'
                ],
                [
                    'name' => '<i class="fas fa-question"></i> Quests'
                ],
                [
                    'name' => '<i class="fas fa-store"></i> Shops'
                ],
            ];
        });
    }

    /**
     * Make global variable for collapse.
     */
    public function bindNamesForCollapse(): void
    {
        $this->app->bind('collapseNames', function (): array {
            return [
                'admin' => [
                    'users' => [
                        'manage' => 'admin-user-manage',
                        'manage-all' => 'admin-user-manage-all',
                    ]
                ],
            ];
        });
    }
}
