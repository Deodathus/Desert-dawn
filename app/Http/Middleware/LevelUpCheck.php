<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;

class LevelUpCheck
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->userService->levelUp())
        {
            return redirect()->route('lvlup');
        }
        else {
            return $next($request);
        }
    }
}
