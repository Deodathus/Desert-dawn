<?php

namespace App\Http\Controllers;

use App\Models\Item\Item;
use App\Services\Card\CardService;
use App\Services\Item\ItemService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * ItemService instance
     *
     * @var $item
     */
    private $itemService;

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

    /**
     * ItemController constructor.
     *
     * @param ItemService $itemService
     * @param CardService $cardService
     * @param UserService $userService
     */
    public function __construct(ItemService $itemService, CardService $cardService, UserService $userService)
    {
        $this->itemService = $itemService;
        $this->cardService = $cardService;
        $this->userService = $userService;
    }

    /**
     * @param Item $item
     * @return RedirectResponse
     */
    public function updateCardActiveStatus(Item $item): RedirectResponse
    {
        $user = $this->userService->getUser();

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
        return view('popup.rewardItem', $this->itemService->prepareDataForRewardView());
    }
}
