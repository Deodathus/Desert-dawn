<?php

namespace App\Services\Shop;

use App\Models\Item\Item;
use App\Models\User\User;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;

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
     * Buy default skill.
     *
     * @param $skill
     * @param $price
     * @return bool
     */
    public function buySkill($skill, $price): bool
    {
        $user = $this->userService->getUser();
        $skillCount = $user->$skill + 1;

        if ($this->userService->paymentForItemByCoins($user, $price))
        {
            return $user->update([
                $skill => $skillCount
            ]);
        }

        return false;
    }

    /**
     * Buy item.
     *
     * @param Item $item
     * @param int $price
     * @return bool
     */
    public function buyItem(Item $item, int $price): bool
    {
        $user = $this->userService->getUser();

        if ($this->userService->paymentForItemByCoins($user, $price))
        {
            return $user->create($item);
        }

        return false;
    }

    /**
     * Returns user's items.
     *
     * @return Collection
     */
    public function prepareDataForSellingView(): Collection
    {
        return $this->userService->getUser()->items;
    }

    /**
     * Delete item from user's items.
     *
     * @param Item $item
     * @return int
     */
    public function sellItem(Item $item): int
    {
        $user = $this->userService->getUser();
        $price = 500;
        if ($this->userService->getCoinsFromSellingItem($user, $price))
        {
            return $user->items()->detach($item->id);
        }

        return 0;
    }
}