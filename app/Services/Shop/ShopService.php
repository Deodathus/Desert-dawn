<?php

namespace App\Services\Shop;

use App\Models\Item\Item;
use App\Models\Item\ItemType;
use App\Models\User\User;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
                $skill => $skillCount,
            ]);
        }

        return false;
    }

    /**
     * Buy item.
     *
     * @param $itemId
     * @return Model|null
     */
    public function buyItem($itemId): ?Model
    {
        $user = $this->userService->getUser();
        $item = Item::find($itemId);
        $price = $item->itemRarity->price;

        if ($this->userService->paymentForItemByCoins($user, $price))
        {
            return $user->items()->save($item);
        }

        return null;
    }

    /**
     * Returns user's items.
     *
     * @return Collection
     */
    public function prepareDataForSellingView(): Collection
    {
        // TODO: MAKE IT NORMAL
        return $this->userService->getUser()->items->where('type', '=', '1');
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