<?php

namespace App\Services\Shop;

use App\Models\User\User;
use App\Services\User\UserService;

class ShopService
{
    /**
     * UserService instance
     *
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @param $skill
     * @return bool
     */
    public function buySkill($skill, $price): bool
    {
        $userId = $this->userService->getUser()->id;
        $user = User::where('id', '=', $userId)->first();
        $skillCount = $user->$skill + 1;

        if ($this->userService->paymentForItemByCoins($user, $price))
        {
            return User::where('id', '=', $userId)->update([
                $skill => $skillCount
            ]);
        }

        return false;
    }
}