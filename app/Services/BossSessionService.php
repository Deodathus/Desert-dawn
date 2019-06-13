<?php

namespace App\Services;

class BossSessionService
{
    /**
     * @param $boss
     */
    public function fillSessionIfEmpty($boss): void
    {
        if (!session()->get('hp') && !session()->get('boss_id'))
        {
            session()->put('hp', $boss->hp);
            session()->put('boss_id', $boss->id);
            session()->put('boss_reward_gold', $boss->reward_gold);
            session()->put('boss_reward_exp', $boss->reward_exp);
            session()->put('boss_reward_gems', $boss->reward_gems);
        }
    }

    /**
     * @return bool
     */
    public function checkIsBossHpZero(): bool
    {
        if (session()->get('hp') === 0 || session()->get('hp') < 0)
        {
            session()->forget('hp');
            session()->forget('boss_id');

            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @return int|null
     */
    public function getBossHpFromSession(): ? int
    {
        return session()->get('hp');
    }

    /**
     * @param $hp
     * @param $damage
     * @param $damageFromCards
     */
    public function minusHpAccordingSkillDamage($hp, $damage, $damageFromCards): void
    {
        $hp -= $damage + $damageFromCards;
        session()->put('hp', $hp);
    }

    /**
     * @return array|null
     */
    public function getBossReward(): ? array
    {
        $bossGold = session()->get('boss_reward_gold');
        $bossExp = session()->get('boss_reward_exp');
        $bossGems = session()->get('boss_reward_gems');
        return [
            'gold' => $bossGold,
            'exp' => $bossExp,
            'gems' => $bossGems,
        ];
    }

    /**
     * @param $boss
     */
    public function fillSessionWithRewardItem($boss): void
    {
        if ($boss->reward_item_rarity != null)
            session()->put('reward_item', true);
    }
}