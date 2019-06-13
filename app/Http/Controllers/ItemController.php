<?php

namespace App\Http\Controllers;

use App\Models\Item\Item;
use App\Services\CardService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Item model instance
     *
     * @var $item
     */
    private $item;

    /**
     * CardService instance
     *
     * @var CardService
     */
    private $cardService;

    /**
     * User service instance
     *
     * @var UserService
     */
    private $userService;

    public function __construct(Item $item, CardService $cardService, UserService $userService)
    {
        $this->item = $item;
        $this->cardService = $cardService;
        $this->userService = $userService;
    }

    /**
     * @param Item $item
     * @return RedirectResponse
     */
    public function updateCardActiveStatus(Item $item): RedirectResponse
    {
        $user = Auth::user();
        if ($this->cardService->updateCardStatus($user, $item) && $this->cardService->getActiveCardsCount() < 7)
        {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'card_limit');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRewardItem(): View
    {
        $rewardCard = $this->userService->getUser()->items->last();

        return view('popup.rewardItem', compact('rewardCard'));
    }
}