<?php

namespace App\Services;

use App\Models\Boss\Boss;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class BossService
{
    private $bossSessionService;
    private $userService;
    private $cardService;

    public function __construct(BossSessionService $bossSessionService, UserService $userService, CardService $cardService)
    {
        $this->bossSessionService = $bossSessionService;
        $this->userService = $userService;
        $this->cardService = $cardService;
    }

    /**
     * @return Collection
     */
    public function getAllBosses(): Collection
    {
        return Boss::all();
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser(): ? Authenticatable
    {
        return $this->userService->getUser();
    }
    /**
     * @param $boss
     */
    public function fillSessionIfEmpty($boss): void
    {
        $this->bossSessionService->fillSessionIfEmpty($boss);
    }

    /**
     * @param Boss $boss
     * @return bool
     */
    public function checkIsHpZero(Boss $boss): bool
    {
        if ($this->bossSessionService->checkIsBossHpZero())
        {
            $reward = $this->bossSessionService->getBossReward();
            $this->userService->setReward($reward);
            $this->createRewardCard($boss);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $skill
     * @return bool
     */
    public function checkSkillCount($skill): bool
    {
        return $skill > 0;
    }

    /**
     * @param $user
     * @param $damage
     * @param $skill
     * @param $damageFromCards
     * @return bool
     */
    public function attack($user, $damage, $skill, $damageFromCards): bool
    {
        $hp = $this->bossSessionService->getBossHpFromSession();
        if ($hp)
        {
            $this->bossSessionService->minusHpAccordingSkillDamage($hp, $user->$damage, $damageFromCards);
            $this->userService->minusSkillsCount($user->id ,$user->$skill, $skill);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $skill
     * @param $damage
     * @return bool
     */
    public function attackOrNot($skill, $damage): bool
    {
        $user = $this->getUser();
        $damageFromCards = $user->getDamageAccordingCardsAttributes($this->cardService);
        if ($user->$skill > 0)
        {
            return $this->attack($user, $damage, $skill, $damageFromCards);
        } else {
            return false;
        }
    }

    /**
     * @param Boss $boss
     */
    public function createRewardCard(Boss $boss): void 
    {
        $this->cardService->createNewCard($boss->name . ' Card', 15, $boss->reward_item_rarity);
    }
}