<?php

namespace App\Services\Quest;

use App\Models\Quest\Mission;
use App\Services\Card\CardService;
use App\Services\User\UserService;

class MissionService extends AbstractQuestService
{
    /**
     * UserService instance.
     *
     * @var UserService $userService
     */
    private $userService;

    /**
     * MissionService constructor.
     *
     * @param CardService $cardService
     * @param UserService $userService
     */
    public function __construct(CardService $cardService, UserService $userService)
    {
        parent::__construct($cardService);
        $this->userService = $userService;
    }

    /**
     * Marked mission as done.
     *
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

    /**
     * Decrement energy after mission.
     *
     * @param Mission $mission
     * @return int|mixed
     */
    public function minusEnergy(Mission $mission): int
    {
        return $this->userService->minusEnergyAccordingMission($mission);
    }
}
