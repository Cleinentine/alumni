<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class PagesController extends Controller
{
    public function index()
    {
        $contact = Contact::first();

        return view('index', ['contact' => $contact]);
    }
}
