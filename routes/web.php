<?php

use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Models\Graduate;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::put('/', [UserController::class, 'logout'])->name('home');
Route::post('/', [MailController::class, 'sendMessage'])->name('sendMessage');

/* FORGOT & CHANGE PASSWORD */

Route::get('change/{token}', [UserController::class, 'changePasswordForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::get('forgot', [UserController::class, 'forgotPasswordForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('change/{token}', [UserController::class, 'changePassword'])->middleware('guest');
Route::post('forgot', [UserController::class, 'resetPassword'])->middleware('guest');

/* ------------------------ */

/* LOGIN, LOGOUT, REGISTER */

Route::get('login', [UserController::class, 'loginForm'])
    ->middleware('guest')
    ->name('login');

Route::get('register', [UserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('login', [UserController::class, 'login'])->middleware('guest');
Route::post('register', [UserController::class, 'store'])->middleware('guest');

/* -------- */

/* TRACER */

Route::get('tracer/graduate', [GraduateController::class, 'index'])
    ->middleware('auth')
    ->name('tracerGraduate');

Route::get('tracer/employment', [EmploymentController::class, 'index'])
    ->middleware('auth')
    ->name('tracerEmployment');

Route::get('tracer/feedback', [FeedbackController::class, 'index'])
    ->middleware('auth')
    ->name('tracerFeedback');

Route::get('tracer/account', [UserController::class, 'index'])
    ->middleware('auth')
    ->name('tracerAccount');

Route::post('tracer/graduate', [GraduateController::class, 'update'])->middleware('auth');
Route::post('tracer/employment', [EmploymentController::class, 'update'])->middleware('auth');
Route::post('tracer/feedback', [FeedbackController::class, 'store'])->middleware('auth');
Route::post('tracer/account', [UserController::class, 'update'])->middleware('auth');

Route::post('tracer/countries', [GraduateController::class, 'getStates']);
Route::post('tracer/states', [GraduateController::class, 'getCities']);
