<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Clinic;
use App\Models\Country;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        $countries = Country::orderBy('name')->get();

        return view('owners.index')
            ->with('clinic', $clinic)
            ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Clinic $clinic)
    {
        $countries = Country::orderBy('name')->get();

        return view('owners.create')
            ->with('countries', $countries)
            ->with('clinic', $clinic);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Clinic $clinic)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'email|required|max:255',
            'phone_primary' => 'required|max:64',
            'address' => 'max:100',
            'postcode' => 'max:10',
            'city' => 'max:64',
            'ssn' => 'max:64',
        ]);

        $owner = new Owner([
            'clinic_id' => $clinic->id,
            'country_id' => $request->get('country_id'),
            'firstname' => $request->get('firstname'),
            'email' => $request->get('email'),
            'phone_primary' => $request->get('phone_primary'),
            'phone_secondary' => $request->get('phone_secondary'),
            'lastname' => $request->get('lastname'),
            'address' => $request->get('address'),
            'postcode' => $request->get('postcode'),
            'city' => $request->get('city'),
            'ssn' => $request->get('ssn'),
        ]);
        $owner->save();

        return redirect()->route('clinics.owners.show', [$clinic, $owner])->with('success', __('message.owner_store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Owner $owner)
    {
        return view('owners.show')->with('clinic', $clinic)->with('owner', $owner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic, Owner $owner)
    {
        $countries = Country::orderBy('name')->get();

        return view('owners.edit')
            ->with('countries', $countries)
            ->with('clinic', $clinic)
            ->with('owner', $owner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Owner $owner)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'email|required|max:255',
            'phone_primary' => 'required|max:64',
            'address' => 'max:255',
            'postcode' => 'max:10',
            'city' => 'max:255',
            'ssn' => 'max:255',
        ]);

        # dd($request->all());

        $owner->country_id = $request->country_id;
        $owner->firstname = $request->firstname;
        $owner->lastname = $request->lastname;
        $owner->email = $request->email;
        $owner->phone_primary = $request->phone_primary;
        $owner->phone_secondary = $request->phone_secondary;
        $owner->address = $request->address;
        $owner->postcode = $request->postcode;
        $owner->city = $request->city;
        $owner->ssn = $request->ssn;

        if ($owner->save()) {
            $request->session()->flash('success', __('message.owner_update_success'));
        } else {
            $request->session()->flash('error', 'message.owner_update_error');
        }

        return redirect()->route('clinics.owners.show', [$clinic, $owner]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinic
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Owner $owner)
    {
        $owner->delete();
        return redirect()->route('clinics.show', [$clinic, $owner])->with('success', __('message.record_destroy_success') . " {$owner->lastname}, {$owner->firstname}");
    }
}
