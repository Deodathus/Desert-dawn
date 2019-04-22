<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserBossService
{
    private $skill_count;
    protected $expMult = 5;

    /**
     * @return Authenticatable|null
     */
    public function getUser(): ? Authenticatable
    {
        return Auth::user();
    }

    /**
     * @param $userId
     * @param $skill_count
     * @param $skill
     */
    public function minusSkillsCount($userId, $skill_count, $skill): void
    {
        $this->skill_count = $skill_count - 1;

        User::where('id', $userId)->update([
            $skill => $this->skill_count,
        ]);
    }

    /**
     * @param $reward
     */
    public function setReward($reward): void
    {
        $user = $this->getUser();
        $userId = $user->id;
        $userGold = $user->coins + $reward['gold'];
        $userExp = $user->exp + $reward['exp'];

        User::where('id', $userId)->update([
            'coins' => $userGold,
            'exp' => $userExp
        ]);

        $this->levelUp();
    }

    public function levelUp()
    {
        $user = $this->getUser();
        $userId = $user->id;
        $userLvlNow = $user->level;
        $userExpNow = $user->exp;
        $userLvlUp = $userLvlNow + 1;
        if ($userExpNow !== 0 && $userExpNow > $userLvlNow * ($this->expMult * $userLvlNow) * 2)
        {
            User::where('id', $userId)->update([
                'level' => $userLvlUp,
                'exp' => 0
            ]);
        }
    }
}