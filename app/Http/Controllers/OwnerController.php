<?php

namespace App\Http\Controllers;

use App\Owner;
use App\Clinic;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        return view('owners.index')->with('clinic', $clinic);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Owner $owner)
    {
        // validate
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'address' => 'max:255',
            'postcode' => 'max:10',
            'city' => 'max:255',
            'ssn' => 'max:255',
            'phone' => 'required|max:255',
            'mobile' => 'required|max:255',
            'email' => 'email|required|max:255',
        ]);

        $owner->firstname = $request->firstname;
        $owner->lastname = $request->lastname;
        $owner->address = $request->address;
        $owner->postcode = $request->postcode;
        $owner->city = $request->city;
        $owner->ssn = $request->ssn;
        $owner->phone = $request->phone;
        $owner->mobile = $request->mobile;
        $owner->email = $request->email;

        if ($owner->save()) {
            $request->session()->flash('success', __('message.owner_update_success'));
        } else {
            $request->session()->flash('error', 'message.owner_update_error');
        }
        
        return redirect()->route('clinics.owners.index', [$clinic, $owner]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Owner $owner)
    {
        $owner->delete();
        return redirect()->route('clinics.owners.index', $clinic->id)->with('success', __('message.owner_destroy_success'));

    }

    public function list(Clinic $clinic)
    {
        $owners = Owner::where('owners.clinic_id', '=', $clinic->id)
                    ->get();
        return Datatables::of($owners)
            ->make(true);
    }

    public function get(Clinic $clinic, Owner $owner)
    {
        $owners = $owner->toArray();

        return response()->json($owners);
    }
}
