<?php

namespace App\Services\Card;

use App\Models\Item\Item;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CardService
{
    /**
     * Item type.
     */
     private const TYPE = 1;

    /**
     * UserService instance
     *
     * @var UserService $userService
     */
    private $userService;

    /**
     * CardService constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveCards(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this
            ->userService
            ->getUser()
            ->items()
            ->where('type', '=', '1')
            ->where('active', '=', '1')
            ->paginate(10);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNotActiveCards(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this
            ->userService
            ->getUser()
            ->items()
            ->where('type', '=', '1')
            ->where('active', '=', '0')
            ->paginate(10);
    }

    /**
     * @param $name
     * @param $requiredLevel
     * @param $rarity
     *
     * @throws \Exception
     */
    public function createNewCard($name, $requiredLevel, $rarity): void
    {
        $user = $this->userService->getUser();

        $newCard = Item::create([
            'item_rarity_id' => $rarity,
            'name' => $name,
            'required_level' => $requiredLevel,
            'type' => self::TYPE,
        ]);

        $user->items()->save($newCard, ['active' => 0]);

        $newCard->itemAttribute()->create([
            'strength' => random_int($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'stamina' => random_int($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'agility' => random_int($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'intellect' => random_int($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'luck' => random_int($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'wisdom' => random_int($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
        ]);
    }

    /**
     * @param $cardId
     */
    public function addExistingCardToUser($cardId): void
    {
        $user = $this->userService->getUser();
        $exampleCard = Item::where('id', '=', $cardId)->get()->first();

        $newCard = Item::create([
            'item_rarity_id' => $exampleCard->item_rarity_id,
            'name' => $exampleCard->name,
            'required_level' => $exampleCard->required_level,
            'type' => $exampleCard->type,
        ]);

        $user->items()->save($newCard, ['active' => 0]);

        $newCard->itemAttribute()->create([
            'strength' => $exampleCard->itemAttribute->strength,
            'stamina' => $exampleCard->itemAttribute->stamina,
            'agility' => $exampleCard->itemAttribute->agility,
            'intellect' => $exampleCard->itemAttribute->intellect,
            'luck' => $exampleCard->itemAttribute->luck,
            'wisdom' => $exampleCard->itemAttribute->luck,
        ]);
    }

    /**
     * @return array
     */
    public function getAttributesFromCards(): array
    {
        $cards = $this->getActiveCards();
        $strength = $cards->map(function ($item)
        {
            return $item->itemAttribute->strength;
        })->sum();
        $stamina = $cards->map(function ($item)
        {
            return $item->itemAttribute->stamina;
        })->sum();
        $agility = $cards->map(function ($item)
        {
            return $item->itemAttribute->agility;
        })->sum();
        $intellect = $cards->map(function ($item)
        {
            return $item->itemAttribute->intellect;
        })->sum();
        $luck = $cards->map(function ($item)
        {
            return $item->itemAttribute->luck;
        })->sum();
        $wisdom = $cards->map(function ($item)
        {
            return $item->itemAttribute->wisdom;
        })->sum();

        return [
                'strength' => $strength,
                'stamina' => $stamina,
                'agility' => $agility,
                'intellect' => $intellect,
                'luck' => $luck,
                'wisdom' => $wisdom,
        ];
    }

    /**
     * @return int
     */
    public function getActiveCardsCount(): int
    {
        return $this->getActiveCards()->count();
    }

    /**
     * @param $user
     * @param $item
     * @return bool|null
     */
    public function updateCardStatus($user, $item): ? bool
    {
        if ($this->getActiveCardsCount() < 6)
        {
            if ($user->items()->where('id', '=', $item->id)->first()->pivot->active === 0)
            {
                return $user->items()->updateExistingPivot($item->id, ['active' => 1]);
            }

            return $user->items()->updateExistingPivot($item->id, ['active' => 0]);
        }

        return $user->items()->updateExistingPivot($item->id, ['active' => 0]);
    }
}
