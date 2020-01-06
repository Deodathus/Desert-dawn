<?php

namespace App\Services\API\User;

use App\Models\User\User;

class APIUserService
{
    /**
     * Prepare data for edit view.
     *
     * @param int $userId
     *
     * @return \App\Models\User\User
     */
    public function getUser(int $userId): User
    {
        return User::find($userId);
    }
}
