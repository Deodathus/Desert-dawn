<?php

namespace App\Services\Boss;

use App\Models\Boss\Boss;
use App\Services\Card\CardService;
use App\Services\User\UserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class BossService
{
    /**
     * BossSessionService instance
     *
     * @var BossSessionService $bossSessionService
     */
    private $bossSessionService;

    /**
     * UserService instance
     *
     * @var UserService $userService
     */
    private $userService;

    /**
     * CardService instance
     *
     * @var CardService $cardService
     */
    private $cardService;

    public function __construct(BossSessionService $bossSessionService, UserService $userService, CardService $cardService)
    {
        $this->bossSessionService = $bossSessionService;
        $this->userService = $userService;
        $this->cardService = $cardService;
    }

    /**
     * Get all bosses
     *
     * @return Collection
     */
    public function getAllBosses(): Collection
    {
        return Boss::all();
    }

    /**
     * Get authentificated user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser(): ? Authenticatable
    {
        return $this->userService->getUser();
    }

    /**
     * Filling the session before boss fight
     *
     * @param $boss
     */
    public function fillSessionIfEmpty($boss): void
    {
        $this->bossSessionService->fillSessionIfEmpty($boss);
    }

    /**
     * Methods to execute after killing the boss
     *
     * @param Boss $boss
     * @return bool
     */
    public function checkIsHpZero(Boss $boss): bool
    {
        if ($this->bossSessionService->checkIsBossHpZero())
        {
            $reward = $this->bossSessionService->getBossReward();
            $this->userService->setRewardAfterBoss($reward);
            $this->bossSessionService->fillSessionWithRewardItem($boss);
            $this->createRewardCard($boss);

            return true;
        } else {
            return false;
        }
    }


    /**
     * Attacking the boss
     *
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
     * Checking skill count and attack
     *
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
     * Making boss's reward card
     *
     * @param Boss $boss
     */
    public function createRewardCard(Boss $boss): void
    {
        if ($boss->reward_item_rarity != 0)
        {
            $this->cardService->createNewCard($boss->name . ' Card', 15, $boss->reward_item_rarity);
        }
    }
}