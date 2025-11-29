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
        if (Auth::user()->roles >= 3) {
            $graduate_id = Auth::user()->graduate->id;
        } else {
            $graduate_id = 0;
        }

        $feedback = Feedback::where('graduate_id', $graduate_id)->first();

        if (!$feedback) {
            $ratingDisplayTexts = ['5 - Excellent', '4 - Good', '3 - Neutral', '2 - Poor', '1 - Very Poor'];
            $ratingValues = [5, 4, 3, 2, 1];
            $yesNo = ['Yes', 'No'];

            $displayTexts = [
                $ratingDisplayTexts,
                $ratingDisplayTexts,
                $ratingDisplayTexts,
                $yesNo,
                $yesNo,
                $yesNo
            ];

            $icons = ['fa-book', 'fa-code', 'fa-user-tie', 'fa-user-graduate', 'fa-building-columns', 'fa-shop'];
            $labels = ['Relevance of the Curriculum (Required)', 'Skills Acquired (Required)', 'Competency (Required)', 'Post Graduate (Required)', 'Engagement with the University (Required)', 'Entrepreneurship (Required)'];
            $loops = [count($ratingValues), count($ratingValues), count($ratingValues), 2, 2, 2];
            $names = ['relevance', 'skills', 'competency', 'post_graduate', 'engagement', 'entrepreneurship'];
            $selected = ['', '', '', '', '', ''];
            $specials = ['', '', '', '', '', ''];

            $values = [
                $ratingValues,
                $ratingValues,
                $ratingValues,
                $yesNo,
                $yesNo,
                $yesNo
            ];

            return view('tracer.feedback', [
                'displayTexts' => $displayTexts,
                'icons' => $icons,
                'labels' => $labels,
                'loops' => $loops,
                'names' => $names,
                'selected' => $selected,
                'specials' => $specials,
                'values' => $values
            ]);
        } else {
            return redirect()->route('tracerGraduate');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role >= 3) {
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
