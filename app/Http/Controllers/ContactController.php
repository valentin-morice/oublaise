<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);


        Mail::to('foo@example.com')
            ->send(new Contact($request));

        redirect('/')->with('message', 'Your message was sent successfully.');
    }
}
