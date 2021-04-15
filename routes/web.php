<?php

use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShiftController::class, 'index'])->name('shifts.index');

Route::get('create', [ShiftController::class, 'create'])->name('shifts.create');

Route::put('/', [ShiftController::class, 'store'])->name('shifts.store');

Route::get('show', [ShiftController::class, 'show'])->name('shifts.show');//llama a un paciente y le asigna un cajero

Route::get('show/callNext', [ShiftController::class, 'callNext'])->name('shifts.callNext');

Route::get('show/callAgain', [ShiftController::class, 'callAgain'])->name('shifts.callAgain');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

