<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\View\View;

class UserCharacteristicsController extends Controller
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
     * @return View
     */
    public function index(): View
    {
        $activeCards = $this->cardService->getActiveCards();
        $notActiveCards = $this->cardService->getNotActiveCards();
        $attributes = $this->cardService->getAttributesFromCards();
        $userPower = auth()->user()->getDamageAccordingCardsAttributes($this->cardService);

        return view('user.index', compact('activeCards', 'notActiveCards', 'attributes', 'userPower'));
    }
}