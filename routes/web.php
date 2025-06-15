<?php

use App\Users\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('users/history/{user_id?}', [UserController::class, 'history']);
    Route::resource('users', \App\Users\Controllers\UserController::class);
    Route::resource('flights', \App\Flights\Controllers\FlightController::class);
    Route::resource('planes', \App\Planes\Controllers\PlaneController::class);
    Route::resource('tickets', \App\Tickets\Controllers\TicketController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
