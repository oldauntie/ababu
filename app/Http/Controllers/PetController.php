<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Clinic;
use App\Owner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        return view('pets.index')->with('clinic', $clinic);
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
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Pet $pet)
    {
        $pet->delete();
        return redirect()->route('clinics.pets.index', $clinic->id)->with('success', __('message.pet_destroy_success'));

    }

    public function list(Clinic $clinic, $return = null)
    {
        $pets = Pet::where('pets.clinic_id', '=', $clinic->id)
            ->join('species', 'pets.species_id', '=', 'species.id')
            ->join('owners', 'pets.owner_id', '=', 'owners.id')
            ->select('pets.*', 'owners.firstname', 'owners.lastname', 'species.familiar_name')
            ->get();

        if ($return == 'datatable') {
            return Datatables::of($pets)
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="pet-visit-button"><button type="button" class="btn btn-sm btn-dark float-left">' . __('translate.visit') . '</button></a>'
                        . '<a href="#" class="pet-edit-button"><button type="button" class="btn btn-sm btn-secondary float-left">' . __('translate.edit') . '</button></a>'
                        . '<a href="#" class="pet-delete-button"><button type="button" class="btn btn-sm btn-danger float-left">' . __('translate.delete') . '</button></a>';
                    ;
                })
                ->make(true);
        }
    }

    public function listByOwner(Clinic $clinic, Owner $owner, $return = null)
    {
        $pets = Pet::where('clinic_id', '=', $clinic->id)
            ->where('owner_id', '=', $owner->id)
            ->get();

        if ($return == 'datatable') {
            return Datatables::of($pets)
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="pet-visit-button"><button type="button" class="btn btn-sm btn-dark float-left">' . __('translate.visit') . '</button></a>';
                })
                ->make(true);
        }
    }
}
