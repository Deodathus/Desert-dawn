<?php

namespace App\Services\Admin;

use App\Models\Boss\Boss;
use App\Models\Item\Item;
use App\Models\User\User;

class AdminDataService
{
    /**
     * Prepare data for index page.
     *
     * @return array
     */
    public function prepareDataForIndexPage(): array
    {
        return [
            'usersCount' => User::count(),
            'bossesCount' => Boss::count(),
            'itemsCount' => Item::count(),
        ];
    }
}