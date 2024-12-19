<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('customer')) {
            return redirect()->route('signin')->withErrors(['message' => 'Please log in to access this page.']);
        }

        return $next($request);
    }
}
