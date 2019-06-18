<?php

namespace App\Services;

use App\Models\Quest\Quest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestService
{
    /**
     * Return collection ob quests
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
}