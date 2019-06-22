<?php

namespace App\Http\Middleware;

use Closure;

class CheckBoss
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $bossPath = str_replace('boss/', '', $request->path());

        if (session()->get('boss_id') && $bossPath === session()->get('boss_id'))
        {
            return $next($request);
        }

        if (!session()->get('boss_id')) {
            return $next($request);
        }

        return redirect()->route('boss.index');
    }
}
