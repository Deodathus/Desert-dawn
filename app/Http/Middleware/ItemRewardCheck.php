<?php

namespace App\Http\Middleware;

use App\Services\BossService;
use Closure;

class ItemRewardCheck
{
    /**
     * @var $bossService
     */
    private $bossService;

    public function __construct(BossService $bossService)
    {
        $this->bossService = $bossService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->get('reward_item') == true)
        {
            session()->forget('reward_item');

            return redirect()->route('item.reward');
        }

        return $next($request);
    }
}
