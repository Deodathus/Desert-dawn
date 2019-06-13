<?php

namespace App\Http\Controllers;

use App\Models\Item\Item;
use App\Services\CardService;
use App\Services\ItemSessionService;
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

    public function __construct(Item $item, CardService $cardService)
    {
        $this->item = $item;
        $this->cardService = $cardService;
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
        $user = auth()->user();
        $rewardCard = $user->items->last();

        return view('popup.rewardItem', compact('rewardCard'));
    }
}