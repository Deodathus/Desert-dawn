<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Services\BossService;
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
        if (!session()->get('hp'))
        {
            session()->put('hp', $boss->hp);
        }
        return view('bosses.show', compact('boss'));
    }

    public function first(Boss $boss)
    {
        $this->bossService->attack($boss);
        if (session()->get('hp') === 0)
        {
            session()->forget('hp');
            return redirect()->route('boss.index');
        }
        else {
            return back();
        }
    }
}
