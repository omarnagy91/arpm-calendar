<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

// Fetch events
Route::get('/events', [EventController::class, 'index']);

// Add an event
Route::post('/events', [EventController::class, 'store']);

// Update an event
Route::put('/events/{event}', [EventController::class, 'update']);

// Delete an event
Route::delete('/events/{event}', [EventController::class, 'destroy']);
