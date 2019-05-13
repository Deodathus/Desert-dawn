<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\View\View;

class UserCharacteristicsController extends Controller
{
    private $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $activeCards = $this->cardService->getActiveCardsForView();
        $notActiveCards = $this->cardService->getNotActiveCardsForView();
        $attributes = $this->cardService->getAttributesFromCards();

        return view('user.index', compact('activeCards', 'notActiveCards', 'attributes'));
    }
}