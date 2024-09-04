<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('Middleware is working');

       // Check if user is authenticated
       if (!Auth::check()) {
        // If not authenticated, redirect to login page or return unauthorized response
        return redirect()->route('home')->with('error', 'Please log in to access this page.');
    }

    // If authenticated, proceed to next request
    return $next($request);
    }
}
