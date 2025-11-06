<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::post('/', [PagesController::class, 'sendMessage'])->name('sendMessage');

Route::get('login', [PagesController::class, 'login'])
    ->middleware('guest')
    ->name('login');
