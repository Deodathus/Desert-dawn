<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserService
{
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

            User::where('id', $userId)->update([
                'level' => $userLvlUp,
                'exp' => 0,
                'skill_1_damage' => $userSkillFirstDamage,
                'skill_2_damage' => $userSkillSecondDamage,
                'skill_3_damage' => $userSkillThirdDamage,
            ]);

            return true;
        }
        else {
            return false;
        }
    }
}