<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $graduate = Graduate::where('user_id', Auth::user()->id)->first();

        $programs = Program::get();

        return view('tracer.graduate', [
            'graduate' => $graduate,
            'programs' => $programs,
        ]);
    }

    public function update(Request $request)
    {
        if (Auth::user()->roles == 4) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'middle_name' => 'nullable|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'last_name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'birth_date' => 'required|date|before:-18 years',
                'year_graduated' => 'required|integer|digits:4|min:1960|max:' . date('Y'),
                'gender' => 'required|in:Male,Female',
                'programs' => 'required|exists:programs,id',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('tracerGraduate')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Graduate::where('graduate_id', Auth::user()->graduate->id)
                    ->where('user_id', Auth::user()->id)
                    ->update([
                        'program_id' => $request->programs,
                        'first_name' => $request->first_name,
                        'middle_name' => $request->middle_name,
                        'last_name' => $request->last_name,
                        'birth_date' => $request->birth_date,
                        'gender' => $request->gender,
                        'year_graduated' => $request->year_graduated,
                        'address' => '',
                    ]);

                return redirect()
                    ->route('tracerGraduate')
                    ->with('successMessage', 'Profile has been updated successfully.');
            }
        } else {
            return redirect()->back();
        }
    }
}
