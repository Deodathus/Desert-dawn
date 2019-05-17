<?php

namespace App\Http\Controllers;

use App\Models\Item\Item;
use App\Services\CardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
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
        $this->cardService->updateCardStatus($user, $item);
        //TODO if -> redirect back else return view(error - 6 cards already are active)

        return redirect()->back();
    }
}
