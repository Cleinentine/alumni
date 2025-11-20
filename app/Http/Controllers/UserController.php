<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\Graduate;
use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            return redirect()->route('tracerGraduate');
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
        $countries = DB::table('countries')
            ->orderBy('name', 'ASC')
            ->get(['id', 'name']);

        $programs = Program::get();

        $cities = '';
        $states = '';

        return view('register', [
            'countries' => json_decode($countries, true),
            'programs' => $programs,
            'cities' => $cities,
            'states' => $states,
        ]);
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
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'middle_name' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'last_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'birth_date' => 'required|date|before:-18 years',
            'country' => 'required|exists:countries,id',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'year_graduated' => 'required|integer|digits:4|min:1960|max:' . date('Y'),
            'gender' => 'required|in:Male,Female',
            'programs' => 'required|exists:programs,id',

            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|phone:mobile|phone:INTERNATIONAL,PH',
            'password' => 'required|confirmed',
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
                'roles' => 4,
            ]);

            $graduate = Graduate::create([
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

            Employment::create([
                'graduate_id' => $graduate->id,
                'industry_id' => null,
                'country_id' => null,
                'state_id' => null,
                'city_id' => null,
                'status' => null,
                'title' => null,
                'company' => null,
                'time_to_first_job' => null,
                'search_methods' => null,
                'progression' => null,
                'unemployment' => null,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('verification.notice');
        }
    }
}
