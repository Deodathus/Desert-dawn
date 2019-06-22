<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Experience multiplier
     *
     * @var int $expMult
     */
    protected $expMult = 5;

    /**
     * Get authentificated user
     *
     * @return Authenticatable|null
     */
    public function getUser(): ? Authenticatable
    {
        return Auth::user();
    }

    /**
     * Minus skill cound after using
     *
     * @param $userId
     * @param $skillCount
     * @param $skill
     */
    public function minusSkillsCount($userId, $skillCount, $skill): void
    {
        $this->$skillCount = $skillCount - 1;

        User::where('id', $userId)->update([
            $skill => $this->$skillCount,
        ]);
    }

    /**
     * Set reward after boss
     *
     * @param $reward
     * @return bool
     */
    public function setReward($reward): bool
    {
        $user = $this->getUser();
        $userId = $user->id;
        $userGold = $user->coins + $reward['gold'];
        $userExp = $user->exp + $reward['exp'];
        $userGems = $user->gems + $reward['gems'];

        return User::where('id', $userId)->update([
            'coins' => $userGold,
            'exp' => $userExp,
            'gems' => $userGems
        ]);
    }

    /**
     * Set reward after boss fight
     *
     * @param $reward
     */
    public function setRewardAfterBoss($reward): void
    {
        $this->setReward($reward);
        $this->cleanSessionAfterBoss();
    }

    /**
     * Clean session after boss fight
     */
    public function cleanSessionAfterBoss(): void
    {
        session()->forget('boss_reward_gold');
        session()->forget('boss_reward_exp');
        session()->forget('boss_reward_gems');
        session()->forget('reward_item');
    }

    /**
     * @return bool
     */
    public function levelUp(): bool
    {
        $user = $this->getUser();
        $userId = $user->id;
        $userLvlNow = $user->level;
        $userExpNow = $user->exp;
        if ($userExpNow >= $userLvlNow * ($this->expMult * $userLvlNow * 2))
        {
            $userSkillFirstDamage = $user->skill_1_damage + ($userLvlNow * $this->expMult);
            $userSkillSecondDamage = $user->skill_2_damage + ($userLvlNow * $this->expMult);
            $userSkillThirdDamage = $user->skill_3_damage + ($userLvlNow * $this->expMult);
            $userLvlUp = $userLvlNow + 1;

            return User::where('id', $userId)->update([
                'level' => $userLvlUp,
                'exp' => 0,
                'skill_1_damage' => $userSkillFirstDamage,
                'skill_2_damage' => $userSkillSecondDamage,
                'skill_3_damage' => $userSkillThirdDamage,
            ]);
        }

        return false;
    }

    /**
     * @param User $user
     * @param int $price
     * @return bool
     */
    public function paymentForItemByCoins (User $user, int $price): bool
    {
        if ($user->coins >= $price)
        {
            $coins = $user->coins - $price;
            return $user->update([
                'coins' => $coins
            ]);
        }

        return false;
    }

    /**
     * Set reward after quest or mission
     *
     * @param $reward
     * @return bool
     */
    public function setRewardAfterQuest($reward): bool
    {
        return $this->setReward($reward);
    }
}