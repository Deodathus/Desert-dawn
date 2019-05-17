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
    public function getActiveCards(): Collection
    {
        $activeCards = $this->userService->getUser()->items()->where('active', '=', '1')->get();

        return $activeCards;
    }

    /**
     * @return Collection
     */
    public function getNotActiveCards(): Collection
    {
        $notActiveCards = $this->userService->getUser()->items()->where('active', '=', '0')->get();

        return $notActiveCards;
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
     * @param $user
     * @param $item
     * @return mixed
     */
    public function updateCardStatus($user, $item): ?bool
    {
        if ($this->getActiveCards()->count() < 6)
        {
            if ($user->items()->where('id', '=', $item->id)->first()->pivot->active == 0)
            {
                $activityStatus = 1;
            } else {
                $activityStatus = 0;
            }
            return $user->items()->updateExistingPivot($item->id, ['active' => $activityStatus]);
        } else {
            $activityStatus = 0;

            return $user->items()->updateExistingPivot($item->id, ['active' => $activityStatus]);
        }
    }
}