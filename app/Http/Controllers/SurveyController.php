<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('survey');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'overall' => 'required|numeric|min:1|max:5',
            'reason' => 'required|in:To update my personal or professional information,To complete the alumni tracer survey,To search for fellow alumni in the directory,To verify alumni information (for employment or academic purposes),To donate or explore ways to support the institution',
            'comment' => 'nullable|max:100'
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
                'comment' => $request->comment
            ]);

            return redirect()
                ->route('survey')
                ->with('successMessage', 'Survey has been successfully sent.');
        }
    }
}
