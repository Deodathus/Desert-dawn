<?php

namespace App\Http\Controllers;

use App\Models\Quest\Quest;
use App\Services\QuestService;
use Illuminate\Http\Request;
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

    public function show(Quest $quest): View
    {
        $missions = $this->questService->getQuestMissions($quest);

        return view('quests.questShow', compact('missions'));
    }
}
