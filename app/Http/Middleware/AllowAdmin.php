<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AllowAdmin
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
        if (Auth::user()) {
            if (!in_array(Auth::user()->role, ['admin', 'moderator', 'test_moderator', 'events_moderator', 'homepage_moderator'])) {
                Auth::logout();
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
        return $next($request);
    }
}
