<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAlreadyInFight
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->get('boss_id'))
        {
            return redirect()->route('boss.show', session()->get('boss_id'));
        }
        else {
            return $next($request);
        }
    }
}
