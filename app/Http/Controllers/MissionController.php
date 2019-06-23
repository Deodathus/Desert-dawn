<?php

namespace App\Http\Controllers;

use App\Models\Quest\Mission;
use App\Services\Quest\MissionService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;

class MissionController extends Controller
{
    /**
     * MissionService instance.
     *
     * @var MissionService $missionService
     */
    private $missionService;

    /**
     * UserService instance.
     *
     * @var UserService $userService
     */
    private $userService;

    public function __construct(MissionService $missionService, UserService $userService)
    {
        $this->missionService = $missionService;
        $this->userService = $userService;
    }

    /**
     * Mark mission as done.
     *
     * @param Mission $mission
     * @return RedirectResponse
     * @throws \Exception
     */
    public function doneMission(Mission $mission): RedirectResponse
    {
        if (!$mission->done && $this->missionService->minusEnergy($mission))
        {
            $this->missionService->markMissionAsDone($mission);
            $reward = $this->missionService->getRewardFromQuest($mission);
            $this->userService->setRewardAfterQuest($reward);
            $this->missionService->setItemsReward($mission);

            return redirect()->back();
        }

        return redirect()->back()->with('mission_error', true);
    }
}
