<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1'
], function () {
    /**
     * Locations
     */
    Route::get('locations', [LocationController::class, 'index'])->name('locations');

    /**
     * Bookings
     */
    Route::post('bookings/calculate', [BookingController::class, 'calculate'])->name('booking.calculate');
    Route::resource('bookings', BookingController::class)->only([
        'index', 'store', 'show',
    ]);
});
