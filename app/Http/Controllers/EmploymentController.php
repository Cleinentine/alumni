<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('tracer.employment', [
            'employment' => $employment,
            'industries' => $industries,
        ]);
    }

    public function storeUpdate(Request $request)
    {
        if (Auth::user()->role == 4) {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'company' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'time_to_first_job' => 'nullable|integer|min:1|max:1000',
                'progression' => 'nullable',
                'status' => 'required|in:Full-time,Part-time,Temporary/Seasonal,Self-Employed,Unemployed',
                'industry' => 'nullable|exists:industries,id',
                'search_methods' => 'nullable|in:JobStreet,LinkedIn,Indeed,Kalibrr,PhilJobNet,Others',
                'unemployment' => 'nullable|max:100',
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
                    $request->progression = null;
                    $request->industry = null;
                    $request->search_methods = null;
                } else {
                    $request->unemployment = '';
                }

                Employment::updateOrCreate([
                    'graduate_id' => Auth::user()->graduate->id,
                ], [
                    'industry_id' => $request->industry,
                    'status' => $request->status,
                    'title' => $request->title,
                    'company' => $request->company,
                    'time_to_first_job' => $request->time_to_first_job,
                    'search_methods' => $request->search_methods,
                    'progression' => $request->progression,
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
