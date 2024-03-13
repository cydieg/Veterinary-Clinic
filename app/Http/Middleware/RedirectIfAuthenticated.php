<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Check the user's role
                switch (Auth::user()->role) {
                    case 'admin':
                        return redirect()->route('admin.home');
                    case 'cashier':
                        return redirect('/cashier');
                    case 'client':
                        return redirect()->route('customer');
                    default:
                        return redirect()->route('dashboard');
                }
            }
        }

        // If the user is not authenticated and the current route is the login page, redirect to home
        if (!$request->is('login')) {
            return $next($request);
        }

        return redirect('/'); // Change to the appropriate home route if needed
    }
}
