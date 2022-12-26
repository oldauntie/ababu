<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->from = Auth::user()->email;
        $contact->type = $request->type;
        $contact->description = $request->description;
        $contact->url = url()->previous();
        if ($contact->save())
        {
            //  Send mail to admin 
            Mail::send('contacts.mail', array(
                'email' => Auth::user()->email,
                'type' => $request->type,
                'url' => url()->previous(),
                'description' => $request->description,

            ), function ($message) use ($request)
            {
                $message->from(Auth::user()->email);
                $message->to('roberto.nannucci@gmail.com', 'Admin')->subject( $request->type . "(" . url()->previous() . ")" );
            });
        }

        // @debug: to simulate an ajax error 
        // return response()->json(['error' => 'Error msg'], 404); // Status code here
        return response()->json(['success' => true]);
    }
}
