<?php

namespace App\Http\Controllers;

use App\Services\Shop\ShopService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * ShopService instance
     *
     * @var ShopService
     */
    private $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('shop.index');
    }

    /**
     * @return RedirectResponse
     */
    public function buyFirstSkill(): RedirectResponse
    {
        if ($this->shopService->buySkill('skill_1', 100))
        {
            return redirect()->route('shop.index')->with('message', true);
        }

        return redirect()->route('shop.index')->with('message', false);
    }

    /**
     * @return RedirectResponse
     */
    public function buySecondSkill(): RedirectResponse
    {
        if ($this->shopService->buySkill('skill_2', 500))
        {
            return redirect()->route('shop.index')->with('message', 'true');
        }

        return redirect()->route('shop.index')->with('message', 'false');
    }

    /**
     * @return RedirectResponse
     */
    public function buyThirdSkill(): RedirectResponse
    {
        if ($this->shopService->buySkill('skill_3', 1000))
        {
            return redirect()->route('shop.index')->with('message', 'true');
        }

        return redirect()->route('shop.index')->with('message', 'false');
    }
}
