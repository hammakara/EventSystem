<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestEvents = \App\Models\Event::latest()->take(4)->get();
    return view('pages.home', compact('latestEvents'));
})->name('home');

Route::get('/all-events',[\App\Http\Controllers\HomeController::class,'allEvents'])->name('allEvents');
Route::get('/event/{event}',[\App\Http\Controllers\HomeController::class,'showEvent'])->name('eventShow');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.store');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.store');


// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[\App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');

    Route::resource('events', EventController::class);
});
