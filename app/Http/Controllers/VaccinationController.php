<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Clinic;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Clinic $clinic, Owner $owner, Pet $pet)
    {
        $request->validate([
            'vaccine' => 'required',
            'batch' => 'required',
            'vaccination_date' => 'required|date|before:tomorrow',
            'booster_date' => 'nullable|date|after:vaccination_date',
            'production_date' => 'nullable|date|before:vaccination_date',
            'expiration_date' => 'nullable|date|after:production_date',
        ]);


        $note = new Vaccination([
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'vaccine' => $request->vaccine,
            'batch' => $request->batch,
            'vaccination_date' => $request->vaccination_date,
            'booster_date' => $request->booster_date,
            'production_date' => $request->production_date,
            'expiration_date' => $request->expiration_date,
            'adverse_reactions' => $request->adverse_reactions,
            'notes' => $request->notes,
        ]);

        # save biometric record
        if ($note->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet])->with('set_active_tab', __('vaccinations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccination $vaccination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccination $vaccination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet, Vaccination $vaccination)
    {
        $request->validate([
            'vaccine' => 'required',
            'batch' => 'required',
            'vaccination_date' => 'required|date|before:tomorrow',
            'booster_date' => 'nullable|date|after:vaccination_date',
            'production_date' => 'nullable|date|before:vaccination_date',
            'expiration_date' => 'nullable|date|after:production_date',
        ]);

        # vaccination
        $vaccination->user_id = auth()->user()->id;
        $vaccination->vaccine = $request->vaccine;
        $vaccination->batch = $request->batch;
        $vaccination->vaccination_date = $request->vaccination_date;
        $vaccination->booster_date = $request->booster_date;
        $vaccination->production_date = $request->production_date;
        $vaccination->expiration_date = $request->expiration_date;
        $vaccination->adverse_reactions = $request->adverse_reactions;
        $vaccination->notes = $request->notes;

        if ($vaccination->save()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }


        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet])->with('set_active_tab', __('vaccinations'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccination $vaccination)
    {
        //
    }
}
