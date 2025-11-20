<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employment = Employment::where('graduate_id', Auth::user()->graduate->id)->first();
        $industries = Industry::get();

        $countries = DB::table('countries')
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        if (empty($countries)) {
            $countries = '';
        } else {
            $countries = json_decode($countries, true);
        }

        if ($employment) {
            $states = DB::table('states')
                ->where('country_id', $employment->country_id)
                ->orderBy('name', 'asc')
                ->get(['id', 'name']);

            $cities = DB::table('cities')
                ->where('state_id', $employment->state_id)
                ->orderBy('name', 'asc')
                ->get(['id', 'name']);

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
        } else {
            $cities = '';
            $states = '';
        }

        return view('tracer.employment', [
            'cities' => $cities,
            'countries' => $countries,
            'employment' => $employment,
            'industries' => $industries,
            'states' => $states,
        ]);
    }

    public function update(Request $request)
    {
        if (Auth::user()->roles == 4) {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'company' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'time_to_first_job' => 'nullable|integer|min:1|max:1000',
                'status' => 'required|in:Full-time,Part-time,Temporary/Seasonal,Self-Employed,Unemployed',
                'industry' => 'nullable|exists:industries,id',
                'search_methods' => 'nullable|in:JobStreet,LinkedIn,Indeed,Kalibrr,PhilJobNet,Others',
                'unemployment' => 'nullable|max:100',
                'country' => 'nullable|exists:countries,id',
                'state' => 'nullable|exists:states,id',
                'city' => 'nullable|exists:cities,id',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('tracerEmployment')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if ($request->status == 'Unemployed') {
                    $request->title = null;
                    $request->company = null;
                    $request->time_to_first_job = null;
                    $request->industry = null;
                    $request->search_methods = null;
                    $request->country_id = null;
                    $request->state_id = null;
                    $request->city_id = null;
                } else {
                    $request->unemployment = '';
                }

                Employment::where('graduate_id', Auth::user()->graduate->id)
                    ->update([
                        'industry_id' => $request->industry,
                        'country_id' => $request->country,
                        'state_id' => $request->state,
                        'city_id' => $request->city,
                        'status' => $request->status,
                        'title' => $request->title,
                        'company' => $request->company,
                        'time_to_first_job' => $request->time_to_first_job,
                        'search_methods' => $request->search_methods,
                        'unemployment' => $request->unemployment,
                    ]);

                return redirect()
                    ->route('tracerEmployment')
                    ->with('successMessage', 'Data has been updated successfully.');
            }
        } else {
            return redirect()->back();
        }
    }
}
