<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsModerator
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'moderator') {
            return redirect('/login');
        }

        return $next($request);
    }
}
