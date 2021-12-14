<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $contact->save();

        // @debug: to simulate an ajax error 
        // return response()->json(['error' => 'Error msg'], 404); // Status code here
        return response()->json(['success' => true]);
    }
}
