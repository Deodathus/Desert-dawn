<?php

namespace App\Http\Controllers;

use App\Models\Boss\Boss;
use App\Services\Boss\BossService;
use App\Services\Card\CardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BossController extends Controller
{
    /**
     * @var BossService
     */
    private $bossService;

    /**
     * BossController constructor.
     * @param BossService $bossService
     */
    public function __construct(BossService $bossService)
    {
        $this->bossService = $bossService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $bosses = $this->bossService->getAllBosses();

        return view('bosses.index', compact('bosses'));
    }

    /**
     * Display the specified resource.
     *
     * @param Boss $boss
     * @param CardService $cardService
     * @return View
     */
    public function show(Boss $boss, CardService $cardService): View
    {
        $user = $this->bossService->getUser();
        $this->bossService->fillSessionIfEmpty($boss);
        $damageFromCards = $user->getDamageAccordingCardsAttributes($cardService);

        return view('bosses.show', compact('boss', 'user', 'damageFromCards'));
    }

    /**
     * @param Boss $boss
     * @return RedirectResponse
     */
    public function firstSkill(Boss $boss): RedirectResponse
    {
        if (!$this->bossService->attackOrNot('skill_1', 'skill_1_damage'))
        {
            return back();
        } else {
            if ($this->bossService->checkIsHpZero($boss))
            {
                return redirect()->route('boss.index');
            } else {
                return back();
            }
        }
    }

    /**
     * @param Boss $boss
     * @return RedirectResponse
     */
    public function secondSkill(Boss $boss): RedirectResponse
    {
        if (!$this->bossService->attackOrNot('skill_2', 'skill_2_damage'))
        {
            return back();
        } else {
            if ($this->bossService->checkIsHpZero($boss))
            {
                return redirect()->route('boss.index');
            } else {
                return back();
            }
        }
    }

    /**
     * @param Boss $boss
     * @return RedirectResponse
     */
    public function thirdSkill(Boss $boss): RedirectResponse
    {
        if (!$this->bossService->attackOrNot('skill_3', 'skill_3_damage'))
        {
            return back();
        } else {
            if ($this->bossService->checkIsHpZero($boss))
            {
                return redirect()->route('boss.index');
            } else {
                return back();
            }
        }
    }
}
