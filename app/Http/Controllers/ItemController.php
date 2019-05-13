<?php

namespace App\Http\Controllers;

use App\Models\Item\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Item $item
     * @return RedirectResponse
     */
    public function updateCardActiveStatus(Item $item): RedirectResponse
    {
        $user = Auth::user();
        if ($user->items()->where('id', '=', $item->id)->first()->pivot->active == 0)
        {
            $activityStatus = 1;
        } else {
            $activityStatus = 0;
        }
        $user->items()->updateExistingPivot($item->id, ['active' => $activityStatus]);

        return redirect()->back();
    }
}
