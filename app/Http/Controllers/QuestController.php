<?php

namespace App\Http\Controllers;

use App\Models\Quest\Quest;
use App\Services\Quest\QuestService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuestController extends Controller
{
    /**
     * QuestService instance.
     *
     * @var QuestService $questService
     */
    private $questService;

    /**
     * UserService instance.
     *
     * @var UserService $userService
     */
    private $userService;

    public function __construct(QuestService $questService, UserService $userService)
    {
        $this->questService = $questService;
        $this->userService = $userService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('quests.questIndex', $this->questService->prepareDataForIndexView());
    }

    /**
     * @param Quest $quest
     * @return View
     */
    public function show(Quest $quest): View
    {
        return view('quests.questShow', $this->questService->prepareDataForShowView($quest));
    }

    /**
     * Getting quest reward.
     *
     * @param Quest $quest
     * @return RedirectResponse
     * @throws \Exception
     */
    public function getQuestReward(Quest $quest): RedirectResponse
    {
        if (!$quest->done)
        {
            if ($this->questService->markQuestAsDone($quest)) {
                $reward = $this->questService->getRewardFromQuest($quest);
                $this->userService->setRewardAfterQuest($reward);
                $this->questService->setItemsReward($quest);

                return redirect()->back()->with('quest_reward', true);
            }

            return redirect()->back()->with('quest_reward', false);
        }

        return redirect()->back()->with('quest', false);
    }
}
