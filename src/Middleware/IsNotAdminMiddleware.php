<?php

namespace Anacreation\MultiAuth\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsNotAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        };

        return $next($request);
    }
}
