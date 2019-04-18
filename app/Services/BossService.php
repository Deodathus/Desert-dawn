<?php

namespace App\Services;

use App\Models\Boss;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BossService
{
    private $bossRepository;

    private $userId;

    public function __construct(Boss $boss)
    {
        $this->bossRepository = $boss;
        $this->userId = Auth::id();
    }

    public function getAllBosses()
    {
        return $this->bossRepository::all();
    }

    /**
     * @param Boss $boss
     * @return array
     */
    public function setReward(Boss $boss)
    {
        $reward = [
            'gold' => $boss->reward_gold,
            'exp' => $boss->reward_exp,
        ];

        $user = User::where('id', $this->userId)->update([
            'exp' => 50
        ]);
    }
}