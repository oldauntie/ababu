<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Clinic;
use App\Pet;
use App\Prescription;
use App\Problem;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        return view('visits.index')->with('clinic', $clinic);
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
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Pet $pet)
    {
        $problems = Problem::where('pet_id', '=', $pet->id)
                    ->orderBy('status_id', 'desc')    
                    ->get();

        $prescriptions = Prescription::where('pet_id', '=', $pet->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        // dd($problems);
        return view('visits.show')
                ->with('clinic', $clinic)
                ->with('problems', $problems)
                ->with('prescriptions', $prescriptions)
                ->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
