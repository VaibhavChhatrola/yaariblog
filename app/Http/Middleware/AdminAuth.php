<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * Checks whether the 'admin' guard has an authenticated session.
     * If not, redirects to the admin login page with an error message.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check the custom 'admin' guard (separate from the default 'web' guard)
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login')
                             ->with('error', 'Please login to access the admin panel.');
        }

        return $next($request);
    }
}
