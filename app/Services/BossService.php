<?php

namespace App\Services;

use App\Models\Boss;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class BossService
{
    private $bossSessionService;
    private $userBossService;

    public function __construct(BossSessionService $bossSessionService, UserBossService $userBossService)
    {
        $this->bossSessionService = $bossSessionService;
        $this->userBossService = $userBossService;
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
        return $this->userBossService->getUser();
    }
    /**
     * @param $boss
     */
    public function fillSessionIfEmpty($boss): void
    {
        $this->bossSessionService->fillSessionIfEmpty($boss);
    }

    /**
     * @return RedirectResponse
     */
    public function checkIsHpZero(): RedirectResponse
    {
        if ($this->bossSessionService->checkIsBossHpZero())
        {
            return redirect()->route('boss.index');
        }
        else {
            return back();
        }
    }

    /**
     * @param $skill
     * @return bool
     */
    public function checkSkillCount($skill): bool
    {
        if ($skill > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @return RedirectResponse|null
     */
    public function attackOrNot(): ? RedirectResponse
    {
        $user = $this->getUser();
        if ($this->checkSkillCount($user->skill_1))
        {
            $this->attack($user, $user->skill_1_damage, 'skill_1');
            return null;
        }
        else {
            return back();
        }
    }

    /**
     * @param $user
     * @param $damage
     * @param $skill
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attack($user, $damage, $skill): ? RedirectResponse
    {
        $hp = $this->bossSessionService->getBossHpFromSession();
        if ($hp)
        {
            $this->bossSessionService->minusHpAccordingSkillDamage($hp, $damage);
            $this->userBossService->minusSkillsCount($user->skill_1, $skill);

            return null;
        }
        else {
            return redirect()->route('boss.index');
        }
    }
    //TODO Check from middleware to services.
}