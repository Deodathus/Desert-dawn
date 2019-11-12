<?php

namespace App\Services\Admin;

use App\Models\User\User;

class AdminUserManageService
{
    /**
     * Prepare data for index view.
     *
     * @return array
     */
    public function prepareDataForIndexView(): array
    {
        return [
            'users' => User::all(),
        ];
    }
}
