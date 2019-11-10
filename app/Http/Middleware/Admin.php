<?php

namespace App\Http\Middleware;

use App\Models\User\User;
use Closure;
use Illuminate\Support\Facades\Gate;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Gate::allows('admin-actions', auth()->user())) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}