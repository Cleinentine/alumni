<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /* FORGOT & CHANGE PASSWORD */

    public function change(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('successMessage', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function reset(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::ResetLinkSent
            ? back()->with(['successMessage' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /* ----------------------- */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput();
        } else if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {
            return redirect()->route('home');
        } else {
            return redirect()
                ->route('login')
                ->withInput()
                ->with('errorMessage', 'Incorrect email or password.');
        }
    }

    public function tracer()
    {
        $industries = Industry::all();
        $programs = Program::get(['id', 'name']);

        return view('tracer', [
            'industries' => $industries,
            'programs' => $programs
        ]);
    }
}
