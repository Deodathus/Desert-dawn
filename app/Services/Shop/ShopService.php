<?php

namespace App\Services\Shop;

use App\Models\Item\Item;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Model;

class ShopService
{
    /**
     * UserService instance
     *
     * @var UserService
     */
    private $userService;

    /**
     * ShopService constructor.
     * @param UserService $userService
     */
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
     * @return array
     */
    public function prepareDataForSellingView(): array
    {
        // TODO: MAKE IT NORMAL
        return [
            'items' => $this->userService->getUser()->items()->where('type', '=', '1')->paginate(10)
        ];
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
        $price = $item->rarity->price;

        if ($this->userService->getCoinsFromSellingItem($user, $price))
        {
            return $user->items()->detach($item->id);
        }

        return 0;
    }
}
