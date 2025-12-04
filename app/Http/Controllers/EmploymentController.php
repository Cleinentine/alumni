<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmploymentController extends Controller
{
    public $employment_statuses;

    public $search_methods;

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->employment_statuses = [
            'Full-time',
            'Part-time',
            'Temporary/Seasonal',
            'Self-Employed',
            'Unemployed',
        ];

        $this->search_methods = [
            'JobStreet',
            'LinkedIn',
            'Indeed',
            'Kalibrr',
            'PhilJobNet',
            'Others',
        ];
    }

    public function index()
    {
        if (Auth::user()->roles <= 2) {
            $graduate_id = 0;
        } else {
            $graduate_id = Auth::user()->graduate->id;
        }

        $employment = Employment::where('graduate_id', $graduate_id)->first();
        $industries = Industry::get();

        ! $employment
            ? $hasValues = [1, 1, 1]
            : $hasValues = [0, 0, 0];

        ! $employment
            ? $values = ['title', 'company', 'time_to_first_job']
            : $values = [$employment->title, $employment->company, $employment->time_to_first_job];

        ! $employment
            ? $selected = ['', '', '']
            : $selected = [$employment->status, $employment->industry_id, $employment->search_methods];

        $displayTexts = [
            $this->employment_statuses,
            $industries,
            $this->search_methods,
        ];

        $icons = ['fa-user-tie', 'fa-building', 'fa-calendar-days'];
        $ids = ['status-id', 'industries-id', 'search-methods-id'];
        $labels = ['Job Title', 'Company Name', 'Months before your First Job'];
        $loops = [count($displayTexts[0]), count($industries), count($displayTexts[2])];
        $names = ['title', 'company', 'time_to_first_job'];
        $placeholders = ['e.g. Chief Executive Officer', 'e.g. Cagayan State University', 'e.g. 9'];
        $selectIcons = ['fa-person-walking-luggage', 'fa-industry', 'fa-magnifying-glass'];
        $selectLabels = ['Employment Status (Required)', 'Company Industry', 'Job Search Methods'];
        $selectNames = ['status', 'industry', 'search_methods'];
        $specials = ['', 'industries', ''];
        $types = ['text', 'text', 'number'];

        if (! $employment) {
            $selectedCity = '';
            $selectedCountry = '';
            $selectedState = '';
        } else {
            $selectedCity = $employment->city_id;
            $selectedCountry = $employment->country_id;
            $selectedState = $employment->state_id;
        }

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
            'displayTexts' => $displayTexts,
            'employment' => $employment,
            'hasValues' => $hasValues,
            'icons' => $icons,
            'ids' => $ids,
            'industries' => $industries,
            'labels' => $labels,
            'loops' => $loops,
            'names' => $names,
            'placeholders' => $placeholders,
            'selected' => $selected,
            'selectedCity' => $selectedCity,
            'selectedCountry' => $selectedCountry,
            'selectedState' => $selectedState,
            'selectIcons' => $selectIcons,
            'selectLabels' => $selectLabels,
            'selectNames' => $selectNames,
            'specials' => $specials,
            'states' => $states,
            'types' => $types,
            'values' => $values,
        ]);
    }

    public function storeUpdate(Request $request)
    {
        if ($request->isMethod('POST') && Auth::user()->roles >= 3) {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'company' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'time_to_first_job' => 'nullable|integer|min:1|max:1000',
                'status' => 'required|'.Rule::in($this->employment_statuses),
                'industry' => 'nullable|exists:industries,id',
                'search_methods' => 'nullable|'.Rule::in($this->search_methods),
                'unemployment' => 'nullable|max:100',
                'country' => 'nullable|exists:countries,id',
                'state' => 'nullable|'.Rule::exists('states', 'id')->where('country_id', $request->country),
                'city' => 'nullable|'.Rule::exists('cities', 'id')->where('state_id', $request->state),
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('tracerEmployment')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if ($request->status == 'Unemployed') {
                    $request->country = null;
                    $request->state = null;
                    $request->city = null;
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

                Employment::updateOrCreate(
                    [
                        'graduate_id' => Auth::user()->graduate->id,
                    ],
                    [
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
                    ]
                );

                return redirect()
                    ->route('tracerEmployment')
                    ->with('successMessage', 'Data has been updated successfully.');
            }
        } else {
            return back();
        }
    }
}
