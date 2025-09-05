<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventDashboardController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ClientEventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

// Home -> Explore
Route::get('/', function () {
    return redirect()->route('client.events.index');
});

// Public explore pages
Route::get('/explore', [ClientEventController::class, 'index'])->name('client.events.index');
Route::get('/explore/{event}', [ClientEventController::class, 'show'])->name('client.events.show');

// Authenticated area
Route::middleware(['auth', 'verified'])->group(function () {
    // Breeze dashboard (redirect to analytics dashboard)
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        // Redirect based on user role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('organizer')) {
            return redirect()->route('dashboard.events');
        } elseif ($user->hasRole('attendee')) {
            return redirect()->route('client.events.index');
        }
        
        // Default fallback
        return redirect()->route('dashboard.events');
    })->name('dashboard');

    // Analytics/overview dashboard (for admin and organizer roles)
    Route::middleware(['role:admin|organizer'])->group(function () {
        Route::get('/dashboard/events', [EventDashboardController::class, 'index'])->name('dashboard.events');
    });

    // Management (admin or organizer) - with specific permissions
    Route::middleware(['role:admin|organizer'])->group(function () {
        // Organizers - with specific permissions
        Route::middleware(['can:organizers.view'])->get('/organizers', [OrganizerController::class, 'index'])->name('organizers.index');
        Route::middleware(['can:organizers.view'])->get('/organizers/{organizer}', [OrganizerController::class, 'show'])->name('organizers.show');
        Route::middleware(['can:organizers.create'])->get('/organizers/create', [OrganizerController::class, 'create'])->name('organizers.create');
        Route::middleware(['can:organizers.create'])->post('/organizers', [OrganizerController::class, 'store'])->name('organizers.store');
        Route::middleware(['can:organizers.edit'])->get('/organizers/{organizer}/edit', [OrganizerController::class, 'edit'])->name('organizers.edit');
        Route::middleware(['can:organizers.edit'])->put('/organizers/{organizer}', [OrganizerController::class, 'update'])->name('organizers.update');
        Route::middleware(['can:organizers.delete'])->delete('/organizers/{organizer}', [OrganizerController::class, 'destroy'])->name('organizers.destroy');
        
        // Events - with specific permissions  
        Route::middleware(['can:events.view'])->get('/events', [EventController::class, 'index'])->name('events.index');
        Route::middleware(['can:events.view'])->get('/events/{event}', [EventController::class, 'show'])->name('events.show');
        Route::middleware(['can:events.create'])->get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::middleware(['can:events.create'])->post('/events', [EventController::class, 'store'])->name('events.store');
        Route::middleware(['can:events.edit'])->get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::middleware(['can:events.edit'])->put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::middleware(['can:events.delete'])->delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        
        // Other resources with basic role check (can be enhanced later)
        Route::resources([
            'venues' => VenueController::class,
            'attendees' => AttendeeController::class,
            'vendors' => VendorController::class,
        ]);
    });

    // Admin-only management - Full system access for admins
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Admin Dashboard and Overview
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('analytics');
        Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
        Route::post('/cache/clear', [App\Http\Controllers\AdminController::class, 'clearCache'])->name('cache.clear');
    });
    
    // User and Role Management (Admin only, but without admin prefix for existing routes)
    Route::middleware(['role:admin'])->group(function () {
        Route::resources([
            'users' => UserController::class,
            'roles' => RoleController::class,
        ]);
        
        // Permission Management
        Route::prefix('permissions')->name('permissions.')->group(function () {
            Route::get('/', [App\Http\Controllers\PermissionController::class, 'index'])->name('index');
            Route::get('/role/{role}', [App\Http\Controllers\PermissionController::class, 'showRole'])->name('role');
            Route::get('/user/{user}', [App\Http\Controllers\PermissionController::class, 'showUser'])->name('user');
            
            // API endpoints for AJAX operations
            Route::post('/assign-role', [App\Http\Controllers\PermissionController::class, 'assignRole'])->name('assign-role');
            Route::delete('/revoke-role', [App\Http\Controllers\PermissionController::class, 'revokeRole'])->name('revoke-role');
            Route::post('/assign-permission-to-role', [App\Http\Controllers\PermissionController::class, 'assignPermissionToRole'])->name('assign-permission-to-role');
            Route::delete('/revoke-permission-from-role', [App\Http\Controllers\PermissionController::class, 'revokePermissionFromRole'])->name('revoke-permission-from-role');
            Route::post('/assign-permission-to-user', [App\Http\Controllers\PermissionController::class, 'assignPermissionToUser'])->name('assign-permission-to-user');
            Route::delete('/revoke-permission-from-user', [App\Http\Controllers\PermissionController::class, 'revokePermissionFromUser'])->name('revoke-permission-from-user');
            
            // API endpoints for fetching data
            Route::get('/api/user/{user}/permissions', [App\Http\Controllers\PermissionController::class, 'getUserPermissions'])->name('api.user-permissions');
            Route::get('/api/role/{role}/permissions', [App\Http\Controllers\PermissionController::class, 'getRolePermissions'])->name('api.role-permissions');
        });
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
