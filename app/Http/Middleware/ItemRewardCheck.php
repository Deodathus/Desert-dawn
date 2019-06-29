<?php

namespace App\Http\Middleware;

use Closure;

class ItemRewardCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->get('reward_item') === true)
        {
            session()->forget('reward_item');

            return redirect()->route('item.reward');
        }

        return $next($request);
    }
}
