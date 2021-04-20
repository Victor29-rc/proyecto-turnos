<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;

Route::get('', [HomeController::class, 'index'])->name('admin.index');

Route::resource('categories', CategoryController::class)->names('admin.categories');

Route::resource('user', UserController::class)->names('admin.users');