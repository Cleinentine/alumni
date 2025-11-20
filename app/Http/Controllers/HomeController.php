<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $hasValues = [0, 0];
        $heading = ['Alumni Directory', 'Tracer System', 'Decision-Support System'];
        $icon = ['fa-address-book', 'fa-chart-line', 'fa-database'];
        $icons = ['fa-tag', 'fa-at'];
        $ids = ['name', 'email'];
        $labels = ['Name', 'Email'];
        $placeholders = ['e.g. John Smith', 'e.g. csuanako@email.com.ph'];
        $subjects = [
            'Bug Report',
            'Directory',
            'Registration',
            'Tracer',
            'Other'
        ];
        $types = ['text', 'email'];
        $values = ['', ''];

        $description = [
            'Reconnect with fellow CSU alumni through our comprehensive directory. Search by name, graduation year, or program to find and connect with old friends and colleagues.',
            'Share your professional journey and stay updated with the latest career opportunities. Our Tracer System helps you track your progress and provides valuable insights for personal growth.',
            'Leverage data-driven insights to make informed decisions. Our Decision-Support System offers analytics and reports that help alumni and the university community understand trends and opportunities for development.'
        ];

        $contact = Contact::first();

        $contact_details = ['Maura, Aparri, Cagayan, 3515', $contact->contact_email, $contact->contact_number];
        $contact_headings = ['Address', 'Contact Email', 'Contact Numbers'];
        $contact_icons = ['fa-map-location-dot', 'fa-at', 'fa-phone'];

        return view('index', [
            'contact_details' => $contact_details,
            'contact_headings' => $contact_headings,
            'contact_icons' => $contact_icons,
            'contact' => $contact,
            'description' => $description,
            'hasValues' => $hasValues,
            'heading' => $heading,
            'icon' => $icon,
            'icons' => $icons,
            'ids' => $ids,
            'labels' => $labels,
            'placeholders' => $placeholders,
            'subjects' => $subjects,
            'types' => $types,
            'values' => $values
        ]);
    }

    public function send(Request $request)
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
