<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user
        $request->authenticate();

        // Regenerate session for security
        $request->session()->regenerate();
        
        $user = Auth::user();
        
        // Log successful login
        Log::info('User logged in', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'roles' => $user->roles->pluck('name')->toArray()
        ]);

        // Update last login timestamp (if you have this field)
        $user->update(['last_login_at' => Carbon::now()]);
        
        // Clear any rate limiting for successful login
        RateLimiter::clear($request->throttleKey());
        
        // Role-based redirect with welcome messages
        $intendedUrl = $request->session()->get('url.intended');
        
        if ($intendedUrl) {
            return redirect($intendedUrl);
        }
        
        // Default role-based redirects
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')
                ->with('success', "Welcome back, {$user->name}! You have admin access.");
        } elseif ($user->hasRole('organizer')) {
            return redirect()->route('dashboard.events')
                ->with('success', "Welcome back, {$user->name}! Ready to manage your events?");
        } elseif ($user->hasRole('attendee')) {
            return redirect()->route('client.events.index')
                ->with('success', "Welcome back, {$user->name}! Discover amazing events.");
        }
        
        // Fallback redirect
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
