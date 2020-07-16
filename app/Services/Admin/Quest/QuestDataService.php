<?php

namespace App\Services\Admin\Quest;

use App\Models\Quest\Quest;
use Illuminate\Database\Eloquent\Collection;

class QuestDataService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllQuests(): Collection
    {
        return Quest::paginate(5);
    }
}
