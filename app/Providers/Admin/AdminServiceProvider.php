<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->bindLinks();
            $this->bindNamesForCollapse();
        });
    }

    /**
     * Make global variable for admin sidebar.
     */
    public function bindLinks(): void
    {
        $this->app->bind('links', function(): array {
            return $this->getLinks();
        });
    }

    /**
     * Get links for leftbar.
     *
     * @return array
     */
    public function getLinks(): array
    {
        $collapseState = $this->prepareStateForLinkCollapse();
        $links = $this->prepareLinks();

        return [
            'users' => [
                'name' => '<i v-html="rawHtml" class="fas fa-users"></i> Users',
                'links' => $links['users'],
                'visible' => $collapseState['users'],
            ],
            'bosses' => [
                'name' => '<i class="fas fa-khanda"></i> Bosses',
                'links' => $links['bosses'],
                'visible' => $collapseState['bosses'],
            ],
            'items' => [
                'name' => '<i class="fas fa-chess-knight"></i> Items'
            ],
            'quests' => [
                'name' => '<i class="fas fa-question"></i> Quests'
            ],
            'shops' => [
                'name' => '<i class="fas fa-store"></i> Shops'
            ],
        ];
    }

    /**
     * Get links.
     *
     * @return array
     */
    public function prepareLinks(): array
    {
        return [
            'users' => [
                [
                    'href' => route('admin.users.index'),
                    'text' => 'Manage',
                ],
                [
                    'href' => route('admin.manage.all.users.index'),
                    'text' => 'Manage All',
                ],
            ],
            'bosses' => [
                [
                    'href' => route('admin.bosses.index'),
                    'text' => 'Manage',
                ],
            ]
        ];
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
                    ],
                    'bosses' => [
                        'manage' => 'admin-boss-manage',
                    ],
                ],
            ];
        });
    }

    /**
     * Prepare state for collapse.
     *
     * @return array
     */
    public function prepareStateForLinkCollapse(): array
    {
        return [
            'users' => $this->getCollapseStateForLinks('users'),
            'bosses' => $this->getCollapseStateForLinks('bosses'),
        ];
    }

    /**
     * Get collapse state for leftbar links.
     *
     * @param string $linkName
     *
     * @return bool
     */
    public function getCollapseStateForLinks(string $linkName): bool
    {
        foreach ($this->prepareLinks()[$linkName] as $link) {
            if (Str::contains(url()->current(), $link['href'])) {
                return true;
            }
        }

        return false;
    }
}
