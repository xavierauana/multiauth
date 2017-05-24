<?php

namespace Anacreation\MultiAuth\Middleware;

use Closure;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!$request->user('admin')) {
            return redirect()->route('admin.login');
        };

        return $next($request);
    }
}
