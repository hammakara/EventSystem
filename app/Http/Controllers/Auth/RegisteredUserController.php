<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Get available roles for registration (exclude admin)
        $availableRoles = Role::whereNotIn('name', ['admin'])->get();
        
        return view('auth.register', compact('availableRoles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'string', 'exists:roles,name', 'not_in:admin'],
            'account_type' => ['nullable', 'string', 'in:attendee,organizer']
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'name.min' => 'Name must be at least 2 characters.',
            'role.not_in' => 'Admin role cannot be selected during registration.',
        ]);

        try {
            // Create user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Assign role based on selection or default to attendee
            $selectedRole = $validatedData['role'] ?? $validatedData['account_type'] ?? 'attendee';
            
            // Verify role exists and is not admin
            $role = Role::where('name', $selectedRole)
                       ->whereNotIn('name', ['admin'])
                       ->first();
            
            if ($role) {
                $user->assignRole($role->name);
                Log::info("User {$user->email} registered with role: {$role->name}");
            } else {
                // Default fallback to attendee
                $user->assignRole('attendee');
                Log::info("User {$user->email} registered with default role: attendee");
            }

            // Fire registered event
            event(new Registered($user));

            // Login user
            Auth::login($user);

            // Add success message
            $request->session()->flash('registration_success', 'Welcome to our Event Management System! Your account has been created successfully.');
            
            // Role-based redirect after registration
            if ($user->hasRole('organizer')) {
                return redirect()->route('dashboard.events')
                    ->with('info', 'As an organizer, you can now create and manage events!');
            } else {
                return redirect()->route('client.events.index')
                    ->with('info', 'Welcome! You can now browse and attend events.');
            }
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return back()->withInput($request->only('name', 'email', 'role', 'account_type'))
                        ->withErrors(['registration' => 'Registration failed. Please try again.']);
        }
    }
}
