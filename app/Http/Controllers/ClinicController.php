<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinic $clinic)
    {
        return view('clinics.show')->with('clinic', $clinic);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinic $clinic)
    {
        return view('clinics.edit')->with('clinic', $clinic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic)
    {
        // validate
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $clinic->name = $request->name;
        $clinic->description = $request->description;
        $clinic->manager = $request->manager;
        $clinic->code = $request->code;
        $clinic->address = $request->address;
        $clinic->postcode = $request->postcode;
        $clinic->city = $request->city;
        $clinic->phone = $request->phone;
        $clinic->website = $request->website;
        $clinic->email = $request->email;

        $imageName = null;
        if ($request->file('logo'))
        {
            $imagePath = $request->file('logo');
            $imageName =  'veterinary-clinic-logo-' . $clinic->id . '-' . Str::random(8) . '.' . $imagePath->getClientOriginalExtension();

            $request->logo->move(public_path('images'), $imageName);

            // delete previous file if exists
            if ($clinic->logo != null && file_exists(public_path('images') . '/' . $clinic->logo))
            {
                unlink(public_path('images') . '/' . $clinic->logo);
            }
            $clinic->logo = $imageName;
        }

        if ($clinic->save())
        {
            $request->session()->flash('success', __('message.clinic_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.clinic_update_error');
        }

        return redirect()->route('clinics.show', $clinic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
