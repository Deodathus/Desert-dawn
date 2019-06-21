<?php

namespace App\Services;

use App\Models\Quest\Mission;

class MissionService
{
    /**
     * CardService instance
     *
     * @var CardService $cardService
     */
    private $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param Mission $mission
     */
    public function markMissionAsDone(Mission $mission): void
    {
        if (!$mission->done)
        {
            $mission->update([
                'done' => true,
            ]);
        }
    }

    /**
     * Get quest or mission as parameter
     *
     * @param $quest
     * @return array
     */
    public function getRewardFromQuest($quest): array
    {
        return $reward = [
            'gold' => $quest->reward_gold,
            'exp' => $quest->reward_exp,
            'gems' => $quest->reward_gems,
        ];
    }

    /**
     * Return reward item rarity id
     *
     * @param $quest
     * @return mixed
     */
    public function getItemRarityReward($quest): ?int
    {
        if ($quest->itemRarity()->count() != 0)
        {
            return $quest->reward_item_rarity;
        }

        return false;
    }

    /**
     * Return reward item id
     *
     * @param $quest
     * @return mixed
     */
    public function getItemReward($quest): ?int
    {
        if ($quest->item()->count() != 0)
        {
            return $quest->reward_item;
        }

        return false;
    }

    /**
     * Setting items reward from mission
     *
     * @param $quest
     */
    public function setItemsReward($quest): void
    {
        if ($this->getItemReward($quest))
        {
            $this->cardService->addExistingCardToUser($quest->reward_item);
        }

        if ($this->getItemRarityReward($quest))
        {
            $this->cardService->createNewCard($quest->name . ' Card', 10, $quest->reward_item_rarity);
        }
    }
}