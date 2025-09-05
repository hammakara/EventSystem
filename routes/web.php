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
        return redirect()->route('dashboard.events');
    })->name('dashboard');

    // Analytics/overview dashboard
    Route::get('/dashboard/events', [EventDashboardController::class, 'index'])->name('dashboard.events');

    // Management (admin or organizer)
    Route::middleware(['role:admin|organizer'])->group(function () {
        Route::resources([
            'organizers' => OrganizerController::class,
            'venues' => VenueController::class,
            'attendees' => AttendeeController::class,
            'events' => EventController::class,
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
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
