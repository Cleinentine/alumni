<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MailController extends Controller
{
    public $subjects;

    public function __construct()
    {
        $this->subjects = [
            'Bug Report',
            'Directory System',
            'Registration Form',
            'Tracer System',
            'Others',
        ];
    }

    public function send(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
                'subject' => 'required|'.Rule::in($this->subjects),
                'message' => 'required|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('home')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Mail::to($request->email)->send(new SendMessage($request));

                return redirect()->route('home');
            }
        } else {
            return back();
        }
    }
}
