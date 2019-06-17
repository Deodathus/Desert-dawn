<?php

namespace App\Services;

use App\Models\Quest\Quest;
use Illuminate\Database\Eloquent\Collection;

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
}