<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('tracer.account');
    }

    /* LOGIN & LOGOUT */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput();
        } elseif (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            return redirect()->route('tracer');
        } else {
            return redirect()
                ->route('login')
                ->withInput()
                ->with('errorMessage', 'Incorrect email or password.');
        }
    }

    public function loginForm()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    /* -------------- */

    /* FORGOT & CHANGE PASSWORD */

    public function changePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('successMessage', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function changePasswordFrom(string $token)
    {
        return view('change', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::ResetLinkSent
            ? back()->with(['successMessage' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function forgotPasswordForm()
    {
        return view('forgot');
    }

    /* ----------------------- */

    /* CRUD APPLICATIONS */

    public function create()
    {
        return view('register');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'nullable|phone:mobile|phone:INTERNATIONAL,PH',
            'password' => 'nullable|confirmed',
            'password_confirmation' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('tracerAccount')
                ->withErrors($validator)
                ->withInput();
        } else {
            Auth::user()->email = $request->email;
            Auth::user()->phone = $request->phone;

            if (Auth::user()->isDirty()) {
                User::where('id', Auth::user()->id)
                    ->update([
                        'email' => $request->email,
                        'phone' => $request->phone
                    ]);
            }

            if (!empty($request->password)) {
                User::where('id', Auth::user()->id)
                    ->update(['password' => Hash::make($request->password)]);
            }

            return redirect()
                ->route('tracerAccount')
                ->with('successMessage', 'Account has been updated successfully.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|phone:mobile|phone:INTERNATIONAL,PH',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::create([
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'roles' => 4,
            ]);

            Auth::login($user);

            return redirect()->route('tracer');
        }
    }
}
