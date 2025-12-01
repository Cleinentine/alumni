<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Graduate;
use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('tracer.account');
    }

    public function verify()
    {
        if (Auth::user()->email_verified_at === null) {
            return view('verify');
        } else {
            return redirect()->route('tracerGraduate');
        }
    }

    /* LOGIN & LOGOUT */

    public function login(Request $request)
    {
        if (! Auth::check() && $request->isMethod('POST')) {
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
                if (Auth::user()->roles >= 3) {
                    return redirect()->route('tracerGraduate');
                } else {
                    return redirect('/admin');
                }
            } else {
                return redirect()
                    ->route('login')
                    ->withInput()
                    ->with('errorMessage', 'Incorrect email or password.');
            }
        } else {
            return back();
        }
    }

    public function loginForm()
    {
        $hasValues = [1, 0];
        $icons = ['fa-at', 'fa-lock'];
        $ids = ['email', 'password'];
        $labels = ['Email', 'Password'];
        $placeholders = ['e.g. csuanako@email.com.ph', ''];
        $types = ['email', 'password'];
        $values = ['', ''];

        return view('login', [
            'hasValues' => $hasValues,
            'icons' => $icons,
            'ids' => $ids,
            'labels' => $labels,
            'placeholders' => $placeholders,
            'types' => $types,
            'values' => $values,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /* -------------- */

    /* FORGOT & CHANGE PASSWORD */

    public function changePassword(Request $request)
    {
        if (! Auth::check() && $request->isMethod('POST')) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email:rfc,dns',
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
        } else {
            return back();
        }
    }

    public function changePasswordFrom(string $token)
    {
        $hasValues = [1, 0, 0];
        $icons = ['fa-at', 'fa-key', 'fa-redo'];
        $ids = ['email', 'password', 'password-confirmation'];
        $labels = ['Email', 'New Password', 'Repeat New Password'];
        $names = ['email', 'password', 'password_confirmation'];
        $placeholders = ['e.g. csuanako@email.com.ph', '', ''];
        $types = ['email', 'password', 'password'];
        $values = ['', '', ''];

        return view('change', [
            'hasValues' => $hasValues,
            'icons' => $icons,
            'ids' => $ids,
            'labels' => $labels,
            'names' => $names,
            'placeholders' => $placeholders,
            'token' => $token,
            'types' => $types,
            'values' => $values,
        ]);
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
        $cities = '';
        $hasValues = [1, 1, 1, 1, 1];
        $selected = ['', ''];
        $states = '';
        $values = ['first_name', 'middle_name', 'last_name', 'birth_date', 'year_graduated'];

        $countries = Country::orderBy('name', 'ASC')
            ->get(['id', 'name']);

        $programs = Program::get();

        return view('register', [
            'cities' => $cities,
            'countries' => json_decode($countries, true),
            'hasValues' => $hasValues,
            'programs' => $programs,
            'selected' => $selected,
            'states' => $states,
            'values' => $values,
        ]);
    }

    public function update(Request $request)
    {
        if (Auth::check() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:rfc,dns|unique:users,email,'.Auth::user()->id,
                'phone' => 'nullable|phone:mobile|phone:INTERNATIONAL,PH',
                'password' => 'nullable|confirmed|regex:/^(?=.*[0-9])(?=.*[!@#$%^&*()])(?=.*[a-zA-Z0-9]).*$/',
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
                            'phone' => $request->phone,
                        ]);
                }

                if (! empty($request->password)) {
                    User::where('id', Auth::user()->id)
                        ->update(['password' => Hash::make($request->password)]);
                }

                return redirect()
                    ->route('tracerAccount')
                    ->with('successMessage', 'Account has been updated successfully.');
            }
        } else {
            return back();
        }
    }

    public function store(Request $request)
    {
        if (! Auth::check() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'middle_name' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'last_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'birth_date' => 'required|date|before:-18 years',
                'country' => 'required|exists:countries,id',
                'state' => 'nullable|'.Rule::exists('states', 'id')->where('country_id', $request->country),
                'city' => 'nullable|'.Rule::exists('cities', 'id')->where('state_id', $request->state),
                'year_graduated' => 'required|integer|digits:4|min:1960|max:'.date('Y'),
                'gender' => 'required|in:Male,Female',
                'programs' => 'required|exists:programs,id',

                'email' => 'required|email:rfc,dns|unique:users,email',
                'phone' => 'nullable|phone:mobile|phone:INTERNATIONAL,PH',
                'password' => 'required|confirmed|regex:/^(?=.*[0-9])(?=.*[!@#$%^&*()])(?=.*[a-zA-Z0-9]).*$/',
                'password_confirmation' => 'required',
                'terms' => 'required|accepted',
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
                    'roles' => 3,
                ]);

                Graduate::create([
                    'user_id' => $user->id,
                    'program_id' => $request->programs,
                    'country_id' => $request->country,
                    'state_id' => $request->state,
                    'city_id' => $request->city,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'birth_date' => $request->birth_date,
                    'gender' => $request->gender,
                    'year_graduated' => $request->year_graduated,
                ]);

                event(new Registered($user));

                Auth::login($user);

                return redirect()->route('verification.notice');
            }
        } else {
            return back();
        }
    }
}
