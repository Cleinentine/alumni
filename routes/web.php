<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::post('/', [PagesController::class, 'sendMessage'])->name('sendMessage');

Route::get('login', [PagesController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [UserController::class, 'login'])
    ->middleware('guest')
    ->name('login');
