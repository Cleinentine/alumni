<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SurveyController extends Controller
{
    public $reasons;

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->reasons = [
            'To update my personal or professional information',
            'To complete the alumni tracer survey',
            'To search for fellow alumni in the directory',
            'To verify alumni information (for employment or academic purposes)',
            'To donate or explore ways to support the institution',
        ];
    }

    public function index()
    {
        $displayTexts = [
            [
                '5 - Excellent',
                '4 - Very Good',
                '3 - Good',
                '2 - Bad',
                '1 - Very Bad',
            ],
            $this->reasons,
        ];

        $icons = ['fa-star', 'fa-eye'];
        $labels = ['Overall Experience (Required)', 'Reason of Visit (Required)'];
        $loops = [5, 5];
        $names = ['overall', 'reason'];
        $specials = ['', ''];

        $values = [
            [5, 4, 3, 2, 1],
            $this->reasons,
        ];

        return view('survey', [
            'displayTexts' => $displayTexts,
            'icons' => $icons,
            'labels' => $labels,
            'loops' => $loops,
            'names' => $names,
            'specials' => $specials,
            'values' => $values,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'overall' => 'required|numeric|min:1|max:5',
                'reason' => 'required|'.Rule::in($this->reasons),
                'comment' => 'nullable|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('survey')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Survey::create([
                    'overall' => $request->overall,
                    'reason' => $request->reason,
                    'comment' => $request->comment,
                    'date_surveyed' => date('y-m-d'),
                ]);

                return redirect()
                    ->route('survey')
                    ->with('successMessage', 'Survey has been successfully sent.');
            }
        } else {
            return back();
        }
    }
}
