<?php

namespace App\Http\Controllers;

use App\Services\Card\CardService;
use App\Services\User\UserService;
use Illuminate\View\View;

class UserCharacteristicsController extends Controller
{
    /**
     * CardSerivce instace.
     *
     * @var CardService $cardService
     */
    private $cardService;

    /**
     * UserService instance.
     *
     * @var UserService $userService
     */
    private $userService;

    public function __construct(CardService $cardService, UserService $userService)
    {
        $this->cardService = $cardService;
        $this->userService = $userService;
    }

    /**
     * Index page of user characretistics.
     *
     * @return View
     */
    public function index(): View
    {
        return view('user.index', $this->userService->prepareDataForUserView($this->cardService));
    }

    /**
     * Updates user bar.
     *
     * @return View
     */
    public function updateUserBar(): View
    {
        return view('user.updatedUserBar');
    }
}