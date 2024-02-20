<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        return view('clinics.show')->with('clinic', $clinic);
    }

    /**
     * Send invitation to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request, Clinic $clinic)
    {
        # validate email address
        $request->validate([
            // Note: invite everyone or email must exists in user table
            // 'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $token = $clinic->serial . '-' . substr(md5($request->email . $clinic->key . Carbon::today()->format('Ymd')), 0, 8);
        Mail::to($request->email)->send(new ClinicJoinMail($clinic, $token));

        return redirect()->route('clinics.show', $clinic)->with('success', __('message.clinic_invitation_success'));
    }
}
