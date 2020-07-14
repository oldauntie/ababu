<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Clinic;
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
    public function destroy(Pet $pet)
    {
        //
    }

    public function ajaxPetList($clinic_id = 0)
    {
        return Datatables::of(Pet::all())
            ->addColumn('action', function ($data) {
                return '<a href="#"><button type="button" class="btn btn-sm btn-primary float-left">'. __('translate.edit') .'</button></a>'
                .'<a href="#"><button type="button" class="btn btn-sm btn-warning float-left">'. __('translate.disable') .'</button></a>'
                .'<a href="#"><button type="button" class="btn btn-sm btn-danger float-left">'. __('translate.delete') .'</button></a>';
            })
            ->make(true);
    }
}
