<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::post('/', [PagesController::class, 'sendMessage'])->name('sendMessage');

Route::get('login', [PagesController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [UserController::class, 'login'])->middleware('guest');

Route::get('tracer', [UserController::class, 'tracer'])->name('tracer');

/* FORGOT & CHANGE PASSWORD */

Route::get('change/{token}', [PagesController::class, 'change'])
    ->middleware('guest')
    ->name('password.reset');

Route::get('forgot', [PagesController::class, 'forgot'])
    ->middleware('guest')
    ->name('password.request');

Route::post('change/{token}', [UserController::class, 'change'])->middleware('guest');
Route::post('forgot', [UserController::class, 'reset'])->middleware('guest');

/* ------------------------ */
