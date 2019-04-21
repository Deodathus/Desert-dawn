<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Services\BossService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BossController extends Controller
{
    private $bossService;
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
        if (!session()->get('hp') && !session()->get('boss_id'))
        {
            session()->put('hp', $boss->hp);
            session()->put('boss_id', $boss->id);
        }
        return view('bosses.show', compact('boss'));
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function firstSkill(): RedirectResponse
    {
        $this->bossService->firstAttack();
        if ($this->bossService->checkIsHpZero())
        {
            return redirect()->route('boss.index');
        }
        else {
            return back();
        }
    }
}
