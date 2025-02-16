<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Invia email di conferma al mittente
        Mail::to($contact->email)->send(new \App\Mail\ContactConfirmation($contact));

        return redirect()->back()->with('message', 'Messaggio inviato! Riceverai una conferma via email.');
    }
}
