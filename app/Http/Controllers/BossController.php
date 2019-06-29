<?php

namespace App\Http\Controllers;

use App\Models\Boss\Boss;
use App\Services\Boss\BossService;
use App\Services\Card\CardService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BossController extends Controller
{
    /**
     * BossService instance.
     *
     * @var BossService $bossService
     */
    private $bossService;

    /**
     * UserService instance.
     *
     * @var UserService $userService
     */
    private $userService;

    public function __construct(BossService $bossService, UserService $userService)
    {
        $this->bossService = $bossService;
        $this->userService = $userService;
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
        $user = $this->userService->getUser();
        $this->bossService->fillSessionIfEmpty($boss);
        $damageFromCards = $user->getDamageAccordingCardsAttributes($cardService);

        return view('bosses.show', compact('boss', 'user', 'damageFromCards'));
    }

    /**
     * @param Boss $boss
     * @return RedirectResponse
     * @throws \Exception
     */
    public function firstSkill(Boss $boss): RedirectResponse
    {
        if (!$this->bossService->attackOrNot('skill_1', 'skill_1_damage'))
        {
            return back();
        }

        return $this->bossService->checkIsHpZero($boss) ? redirect()->route('boss.index') : back();
    }

    /**
     * @param Boss $boss
     * @return RedirectResponse
     * @throws \Exception
     */
    public function secondSkill(Boss $boss): RedirectResponse
    {
        if (!$this->bossService->attackOrNot('skill_2', 'skill_2_damage'))
        {
            return back();
        }

        return $this->bossService->checkIsHpZero($boss) ? redirect()->route('boss.index') : back();
    }

    /**
     * @param Boss $boss
     * @return RedirectResponse
     * @throws \Exception
     */
    public function thirdSkill(Boss $boss): RedirectResponse
    {
        if (!$this->bossService->attackOrNot('skill_3', 'skill_3_damage'))
        {
            return back();
        }

        return $this->bossService->checkIsHpZero($boss) ? redirect()->route('boss.index') : back();
    }
}
