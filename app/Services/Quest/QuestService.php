<?php

namespace App\Services\Quest;

use App\Models\Quest\Quest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestService extends AbstractQuestService
{
    /**
     * Return collection of quests
     *
     * @return LengthAwarePaginator
     */
    public function getAllQuests(): LengthAwarePaginator
    {
        return Quest::paginate(10);
    }

    /**
     * Prepares data for index view.
     *
     * @return array
     */
    public function prepareDataForIndexView(): array
    {
        return [
            'quests' => $this->getAllQuests(),
        ];
    }

    /**
     * Prepares data for show view.
     *
     * @param Quest $quest
     *
     * @return array
     */
    public function prepareDataForShowView(Quest $quest): array
    {
        return [
            'missions' => $this->getQuestMissions($quest),
        ];
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
        return $quest->mission()->where('done', '=', '0')->count() === 0 && $quest->done === 0 ? $quest->update([
            'done' => true,
        ]) : false;
    }
}
