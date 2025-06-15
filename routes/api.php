<?php

use App\Books\Controllers\Api\BookApiController;
use App\Bookshelves\Controllers\Api\BookshelfApiController;
use App\Flights\Controllers\Api\FlightApiController;
use App\Users\Controllers\Api\UserApiController;
use App\Floors\Controllers\Api\FloorApiController;
use App\Loans\Controllers\Api\LoanApiController;
use App\Planes\Controllers\Api\PlaneApiController;
use App\Reservations\Controllers\Api\ReservationApiController;
use App\Tickets\Controllers\Api\TicketApiController;
use App\Zones\Controllers\Api\ZoneApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/users', [UserApiController::class, 'index']);
    Route::get('/users/{user}', [UserApiController::class, 'show']);
    Route::post('/users', [UserApiController::class, 'store']);
    Route::put('/users/{user}', [UserApiController::class, 'update']);
    Route::delete('/users/{user}', [UserApiController::class, 'destroy']);
});
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/flights', [FlightApiController::class, 'index']);
    Route::get('/flights/{flight}', [FlightApiController::class, 'show']);
    Route::post('/flights', [FlightApiController::class, 'store']);
    Route::put('/flights/{flight}', [FlightApiController::class, 'update']);
    Route::delete('/flights/{flight}', [FlightApiController::class, 'destroy']);
});
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/planes', [PlaneApiController::class, 'index']);
    Route::get('/planes/{plane}', [PlaneApiController::class, 'show']);
    Route::post('/planes', [PlaneApiController::class, 'store']);
    Route::put('/planes/{plane}', [PlaneApiController::class, 'update']);
    Route::delete('/planes/{plane}', [PlaneApiController::class, 'destroy']);
});
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/tickets', [TicketApiController::class, 'index']);
    Route::get('/tickets/{ticket}', [TicketApiController::class, 'show']);
    Route::post('/tickets', [TicketApiController::class, 'store']);
    Route::put('/tickets/{ticket}', [TicketApiController::class, 'update']);
    Route::delete('/tickets/{ticket}', [TicketApiController::class, 'destroy']);
});

