<?php

namespace App\Http\Controllers;

use App\Models\Item\Item;
use App\Services\CardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * @var CardService
     */
    private $cardService;

    public function __construct(CardService $cardService)
    {
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
}