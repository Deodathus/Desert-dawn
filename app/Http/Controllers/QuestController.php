<?php

namespace App\Http\Controllers;

use App\Models\Quest\Quest;
use App\Services\Quest\QuestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuestController extends Controller
{
    /**
     * QuestService instance
     *
     * @var QuestService $questService
     */
    private $questService;

    public function __construct(QuestService $questService)
    {
        $this->questService = $questService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $quests = $this->questService->getAllQuests();

        return view('quests.questIndex', compact('quests'));
    }

    /**
     * @param Quest $quest
     * @return View
     */
    public function show(Quest $quest): View
    {
        $missions = $this->questService->getQuestMissions($quest);

        return view('quests.questShow', compact('missions'));
    }

    /**
     * Getting quest reward
     *
     * @param Quest $quest
     * @return RedirectResponse
     */
    public function getQuestReward(Quest $quest): RedirectResponse
    {
        if ($this->questService->checkQuestProgress($quest))
        {
            return redirect()->back()->with('quest_reward', true);
        } else {
            return redirect()->back()->with('quest_reward', false);
        }
    }
}
