<?php

namespace App\Http\Middleware;

use App\Services\User\UserService;
use Closure;
use Illuminate\Support\Facades\Auth;

class LevelUpCheck
{
    /**
     * @var UserService
     */
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
        if (Auth::user())
        {
            if($this->userService->levelUp())
            {
                return redirect()->route('lvlup');
            }
            else {
                return $next($request);
            }
        }
        else {
            return $next($request);
        }
    }
}
