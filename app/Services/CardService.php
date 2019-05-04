<?php

namespace App\Services;

use App\Models\Item\Item;
use Illuminate\Database\Eloquent\Collection;

class CardService
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Collection
     */
    public function getActiveCardsForView(): Collection
    {
        $activeCards = $this->userService->getUser()->items()->where('active', '=', '1')->get();

        return $activeCards;
    }

    /**
     * @return Collection
     */
    public function getNotActiveCardsForView(): Collection
    {
        $deactivatedCards = $this->userService->getUser()->items()->where('active', '=', '0')->get();

        return $deactivatedCards;
    }

    /**
     * @param $name
     */
    public function createNewCard($name): void
    {
        $user = $this->userService->getUser();
        $requiredLevel = 5;
        $rarity = rand(1, 2);
        $newCard = Item::create([
            'item_rarity_id' => $rarity,
            'name' => $name,
            'required_level' => $requiredLevel,
        ]);
        $user->items()->save($newCard, ['active' => 1]);
        $newCard->itemAttribute()->create([
            'strength' => rand($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'stamina' => rand($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'agility' => rand($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'intellect' => rand($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'luck' => rand($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
            'wisdom' => rand($newCard->rarity->min_stat_multiply, $newCard->rarity->max_stat_multiply),
        ]);
    }

    public function getAttributesFromCards()
    {
        $cards = $this->getActiveCardsForView();
        $stamina = $cards->map(function ($item)
        {
            return $item->itemAttribute->stamina;
        })->sum();

        return $stamina;
    }
}