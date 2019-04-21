<?php

namespace App\Http\Middleware;

use Closure;

class CheckBoss
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
        $bossPath = str_replace('boss/', '', $request->path());
        dd(session());
        if (session()->get('boss_id') && $bossPath == session()->get('boss_id'))
        {
            return $next($request);
        }
        else {
            return redirect()->route('boss.show', session()->get('boss_id'));
        }
    }
}
