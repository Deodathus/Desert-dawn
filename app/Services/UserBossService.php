<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserBossService
{
    private $userId;
    private $skill_count;

    /**
     * @return Authenticatable|null
     */
    public function getUser(): ? Authenticatable
    {
        return Auth::user();
    }

    /**
     * @param $skill_count
     * @param $skill
     */
    public function minusSkillsCount($skill_count, $skill): void
    {
        $this->userId = Auth::id();
        $this->skill_count = $skill_count - 1;

        User::where('id', $this->userId)->update([
            $skill => $this->skill_count,
        ]);
    }
}