<?php

use App\Http\API\EventApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {

    Route::get('/active-events', [EventApiController::class, 'list_active']);
    Route::get('/events/{id}', [EventApiController::class, 'view']);
    Route::post('/events', [EventApiController::class, 'create']);
    Route::put('/events/{id}', [EventApiController::class, 'update']);
    Route::patch('/events/{id}', [EventApiController::class, 'partial_update']);
    Route::delete('/events/{id}', [EventApiController::class, 'delete']);
    Route::get('/events', [EventApiController::class, 'list']);
});
