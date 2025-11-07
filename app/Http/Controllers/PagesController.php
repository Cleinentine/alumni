<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        $contact = Contact::first();

        return view('index', ['contact' => $contact]);
    }

    /* FORGOT & CHANGE PASSWORD */

    public function change(string $token)
    {
        return view('change', ['token' => $token]);
    }

    public function forgot()
    {
        return view('forgot');
    }

    /* ------------------------ */

    public function login()
    {
        return view('login');
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|in:Bug Report,Directory,Registration,Tracer,Other',
            'message' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('home')
                ->withErrors($validator)
                ->withInput();
        } else {
            Mail::to('cleinentine@gmail.com')->send(new SendMessage($request));

            return redirect()->route('home');
        }
    }
}
