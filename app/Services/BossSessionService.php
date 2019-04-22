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
     */
    public function minusHpAccordingSkillDamage($hp, $damage): void
    {
        $hp -= $damage;
        session()->put('hp', $hp);
    }
}