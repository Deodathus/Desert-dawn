<?php

namespace App\Services;

use App\Models\Boss;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class BossService
{
    private $bossSessionService;
    private $userService;

    public function __construct(BossSessionService $bossSessionService, UserService $userService)
    {
        $this->bossSessionService = $bossSessionService;
        $this->userService = $userService;
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
     * @return bool
     */
    public function checkIsHpZero(): bool
    {
        if ($this->bossSessionService->checkIsBossHpZero())
        {
            $reward = $this->bossSessionService->getBossReward();
            $this->userService->setReward($reward);

            return true;
        }
        else {
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
     * @return bool
     */
    public function attack($user, $damage, $skill): bool
    {
        $hp = $this->bossSessionService->getBossHpFromSession();
        if ($hp)
        {
            $this->bossSessionService->minusHpAccordingSkillDamage($hp, $user->$damage);
            $this->userService->minusSkillsCount($user->id ,$user->$skill, $skill);

            return true;
        }
        else {
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
        if ($user->$skill > 0)
        {
            return $this->attack($user, $damage, $skill);
        }
        else {
            return false;
        }
    }
}