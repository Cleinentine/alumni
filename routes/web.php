<?php

use App\Http\Controllers\ContactFormSubmissionController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::put('/', [UserController::class, 'logout'])->name('home');
Route::post('/', [MailController::class, 'sendMessage'])
    ->middleware(ProtectAgainstSpam::class)
    ->name('sendMessage');

Route::get('privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('terms', function () {
    return view('terms');
})->name('terms');

/* DIRECTORY */

Route::get('directory', [DirectoryController::class, 'index'])->name('directory');

/* --------- */

/* EMAIL VERIFICATION */

Route::get('verify', function () {
    return view('verify');
})->middleware('auth')->name('verification.notice');

Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('tracerEmployment');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Email Verification Link has been sent successfully.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/* ------------------ */

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
Route::post('register', [UserController::class, 'store'])->middleware(['guest', ProtectAgainstSpam::class]);

/* -------- */

/* SURFEY */

Route::get('survey', [SurveyController::class, 'index'])->name('survey');
Route::post('survey', [SurveyController::class, 'store'])->middleware(ProtectAgainstSpam::class);

/* ------ */

/* TRACER */

Route::get('tracer/graduate', [GraduateController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('tracerGraduate');

Route::get('tracer/employment', [EmploymentController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('tracerEmployment');

Route::get('tracer/feedback', [FeedbackController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('tracerFeedback');

Route::get('tracer/account', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('tracerAccount');

Route::post('tracer/graduate', [GraduateController::class, 'update'])->middleware(['auth', 'verified']);
Route::post('tracer/employment', [EmploymentController::class, 'update'])->middleware(['auth', 'verified']);
Route::post('tracer/feedback', [FeedbackController::class, 'store'])->middleware(['auth', 'verified']);
Route::post('tracer/account', [UserController::class, 'update'])->middleware(['auth', 'verified']);

Route::post('tracer/countries', [GraduateController::class, 'getStates']);
Route::post('tracer/states', [GraduateController::class, 'getCities']);
