<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::where('graduate_id', Auth::user()->graduate->id)->first();

        if (! $feedback) {
            return view('tracer.feedback');
        } else {
            return redirect()->route('tracerGraduate');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == 4) {
            $validator = Validator::make($request->all(), [
                'relevance' => 'required|numeric|digits:1|min:1|max:5',
                'skills' => 'required|numeric|digits:1|min:1|max:5',
                'competency' => 'required|numeric|digits:1|min:1|max:5',
                'post_graduate' => 'required|in:Yes,No',
                'engagement' => 'required|in:Yes,No',
                'entrepreneurship' => 'required|in:Yes,No',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('tracerFeedback')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Feedback::create([
                    'graduate_id' => Auth::user()->graduate->id,
                    'relevance' => $request->relevance,
                    'skills' => $request->skills,
                    'competency' => $request->competency,
                    'post_graduate' => $request->post_graduate,
                    'engagement' => $request->engagement,
                    'entrepreneurship' => $request->entrepreneurship,
                    'date_submitted' => NOW(),
                ]);

                return redirect()
                    ->route('tracerGraduate')
                    ->with('successMessage', 'Feedback has been sent successfully.');
            }
        } else {
            return redirect()->back();
        }
    }
}
