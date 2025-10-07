<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }

        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
