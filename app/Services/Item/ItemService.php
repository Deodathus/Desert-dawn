<?php

namespace App\Services\Item;

use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;

class ItemService
{
    /**
     * UserService instance.
     *
     * @var UserService $userService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Return all user's items except cards.
     *
     * @return Collection
     */
    public function getUserItems(): Collection
    {
        return $this->userService->getUser()->items->where('type', '!=', '1');
    }

    public function prepareDataForRewardView(): array
    {
        return [
            'rewardCard' => $this->userService->getLastUserItem(),
        ];
    }
}
