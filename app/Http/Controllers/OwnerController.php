<?php

namespace App\Http\Controllers;

use App\Owner;
use App\Clinic;
use App\Country;

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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Clinic $clinic)
    {
        // validate
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

        return redirect()->route('clinics.owners.index', $clinic)->with('success', __('message.owner_create_success'));
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
            'email' => 'email|required|max:255',
            'phone_primary' => 'required|max:64',
            'address' => 'max:255',
            'postcode' => 'max:10',
            'city' => 'max:255',
            'ssn' => 'max:255',
        ]);

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
            ->addColumn('action', function ($data) {
                return '<a href="#" class="owner-edit-button"><button type="button" class="btn btn-sm btn-secondary float-left">' . __('translate.edit') . '</button></a>'
                    . '<a href="#" class="owner-delete-button"><button type="button" class="btn btn-sm btn-danger float-left">' . __('translate.delete') . '</button></a>';
            })
            ->make(true);
    }

    
    public function get(Clinic $clinic, Owner $owner)
    {
        $result = $owner->toArray();
        return response()->json($result);
    }


    public function search(Clinic $clinic, Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $owners = Owner::where('clinic_id', '=', $clinic->id)->orderby('lastname', 'asc')->select('id', 'firstname', 'lastname')->limit(5)->get();
        } else {
            $owners = Owner::where('clinic_id', '=', $clinic->id)->where('firstname', 'like', '%' . $search . '%')->orWhere('lastname', 'like', '%' . $search . '%')->orderby('lastname', 'asc')->select('id', 'firstname', 'lastname')->limit(5)->get();
        }

        $response = array();
        foreach ($owners as $owner) {
            $response[] = array(
                "id" => $owner->id,
                "text" => $owner->firstname . " " . $owner->lastname
            );
        }

        echo json_encode($response);
        exit;
    }
}
