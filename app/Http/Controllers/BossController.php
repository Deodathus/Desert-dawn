<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Services\BossService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BossController extends Controller
{
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
     * @return View
     */
    public function show(Boss $boss): View
    {
        $user = $this->bossService->getUser();
        $this->bossService->fillSessionIfEmpty($boss);

        return view('bosses.show', compact('boss', 'user'));
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function firstSkill(): RedirectResponse
    {
        $this->bossService->attackOrNot();

        return $this->bossService->checkIsHpZero();
    }
}
