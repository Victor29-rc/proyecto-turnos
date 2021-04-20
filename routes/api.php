<?php

use App\Http\Controllers\Api\ShiftController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('turnos', [ShiftController::class, 'index']);
Route::get('turnos/{id}', [ShiftController::class, 'show']);
Route::put('turnos/{id}', [ShiftController::class, 'update']);

