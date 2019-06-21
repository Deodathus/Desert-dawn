<?php

namespace App\Services\Quest;

use App\Models\Quest\Mission;

class MissionService extends AbstractQuestService
{
    /**
     * @param Mission $mission
     */
    public function markMissionAsDone(Mission $mission): void
    {
        if (!$mission->done)
        {
            $mission->update([
                'done' => true,
            ]);
        }
    }
}