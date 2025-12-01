<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $graduate = Graduate::where('user_id', Auth::user()->id)->first();
        $programs = Program::get();

        $hasValues = [0, 0, 0, 0, 0];

        ! $graduate
            ? $selected = ['', '']
            : $selected = [$graduate->gender, $graduate->program_id];

        ! $graduate
            ? $values = ['', '', '', '', '']
            : $values = [
                $graduate->first_name,
                $graduate->middle_name,
                $graduate->last_name,
                $graduate->birth_date,
                $graduate->year_graduated,
            ];

        if (Auth::user()->roles <= 2) {
            $country_id = 0;
            $state_id = 0;
        } else {
            $country_id = $graduate->country_id;
            $state_id = $graduate->state_id;
        }

        $countries = DB::table('countries')
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        $selectedCity = DB::table('cities')
            ->where('state_id', $state_id)
            ->orderBy('name', 'asc')
            ->get(['id'], ['name']);

        $selectedState = DB::table('states')
            ->where('country_id', $country_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        $states = DB::table('states')
            ->where('country_id', $country_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        $cities = DB::table('cities')
            ->where('state_id', $state_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        if (empty($countries)) {
            $countries = '';
        } else {
            $countries = json_decode($countries, true);
        }

        if (empty($states)) {
            $states = '';
        } else {
            $states = json_decode($states, true);
        }

        if (empty($cities)) {
            $cities = '';
        } else {
            $cities = json_decode($cities, true);
        }

        return view('tracer.graduate', [
            'cities' => $cities,
            'countries' => $countries,
            'graduate' => $graduate,
            'hasValues' => $hasValues,
            'programs' => $programs,
            'selected' => $selected,
            'selectedCity' => $selectedCity,
            'selectedState' => $selectedState,
            'states' => $states,
            'values' => $values,
        ]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('POST') && Auth::user()->roles >= 3) {
            $checkAlumni = Graduate::where('user_id', '!=', Auth::user()->id)
                ->where('program_id', $request->program_id)
                ->where('first_name', $request->first_name)
                ->where('last_name', $request->last_name)
                ->where('year_graduated', $request->year_graduated)
                ->first();

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
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('tracerGraduate')
                    ->withErrors($validator)
                    ->withInput();
            } elseif ($checkAlumni) {
                return redirect()
                    ->route('tracerGraduate')
                    ->with('duplicateData', 'Alumni with the same data already exists.')
                    ->withErrors(($validator))
                    ->withInput();
            } else {
                Graduate::where('id', Auth::user()->graduate->id)
                    ->where('user_id', Auth::user()->id)
                    ->update([
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

                return redirect()
                    ->route('tracerGraduate')
                    ->with('successMessage', 'Profile has been updated successfully.');
            }
        } else {
            return back();
        }
    }
}
