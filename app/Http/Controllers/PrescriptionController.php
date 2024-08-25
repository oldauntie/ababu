<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Clinic $clinic, Owner $owner, Pet $pet)
    {
        $request->validate([
            'medicine_id' => 'required',
            'prescription_date' => 'required|before:tomorrow',
            'quantity' => 'required|numeric|min:1|max:65535',
            'dosage' => 'required|max:50',
            'duration' => 'max:50',
        ]);

        $prescription = new Prescription([
            'medicine_id' => $request->medicine_id,
            'pet_id' => $pet->id,
            'problem_id' => $request->problem_id,
            'user_id' => auth()->user()->id,
            'prescription_date' => $request->prescription_date,
            'quantity' => $request->quantity,
            'dosage' => $request->dosage,
            'duration' => $request->duration,
            'in_evidence' => $request->has('in_evidence'),
            'notes' => $request->notes,
            'print_notes' => $request->has('print_notes'),
        ]);

        # save note record
        if ($prescription->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function get(Clinic $clinic, Prescription $prescription)
    {
        return $prescription->toJson();
    }
}
