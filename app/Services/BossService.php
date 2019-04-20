<?php

namespace App\Services;

use App\Models\Boss;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @return Collection
     */
    public function getAllBosses(): Collection
    {
        return $this->bossRepository->all();
    }

    /**
     * @param Boss $boss
     */
    public function getAndSetReward(Boss $boss)
    {
        $reward = [
            'gold' => $boss->reward_gold,
            'exp' => $boss->reward_exp,
        ];

        User::where('id', $this->userId)->update([
            'exp' => $reward['exp'],
            'coins' => $reward['reward_gold']
        ]);
    }

    public function attack($boss)
    {
        if (session()->get('hp'))
        {
            $hp = session()->get('hp');
            $hp -= 100;
            session()->put('hp', $hp);
        }
        else {
            session()->put('hp', $boss->hp);
        }
    }
}