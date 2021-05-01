<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Supervisor\RerportController;

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.index')->name('admin.index');

Route::resource('categories', CategoryController::class)->middleware('can:admin.categories.index')->names('admin.categories');

Route::resource('user', UserController::class)->middleware('can:admin.users.index')->names('admin.users');

Route::get('reports', [RerportController::class, 'index'])->middleware('can:admin.reports.index')->name('admin.reports.index');

Route::get('reports/create', [RerportController::class, 'create'])->middleware('can:admin.reports.index')->name('admin.reports.create');

/* Route::get('reports/print', [RerportController::class, 'print'])->middleware('can:admin.reports.index')->name('admin.reports.print'); */