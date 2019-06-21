<?php

namespace App\Services\Quest;

use App\Models\Quest\Quest;
use Illuminate\Database\Eloquent\Collection;

class QuestService extends AbstractQuestService
{
    /**
     * Return collection of quests
     *
     * @return Collection
     */
    public function getAllQuests(): Collection
    {
        return Quest::all();
    }

    /**
     * @param Quest $quest
     * @return mixed
     */
    public function getQuestMissions(Quest $quest): Collection
    {
        return $quest->mission;
    }

    /**
     * Checking the quest progress
     *
     * @param Quest $quest
     * @return bool
     */
    public function markQuestAsDone(Quest $quest): bool
    {
        if ($quest->mission()->where('done', '=', '0')->count() == 0 && $quest->done == 0)
        {
            return $quest->update([
                'done' => true,
            ]);
        } else {
            return false;
        }
    }
}