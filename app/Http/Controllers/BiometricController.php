<?php

namespace App\Http\Controllers;

use App\Models\Biometric;
use App\Models\Clinic;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;

class BiometricController extends Controller
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
            'heigth' => 'required',
            'length' => 'required',
            'weigth' => 'required',
            'temperature' => 'required',
        ]);


        $note = new Biometric([
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'heigth' => $request->heigth,
            'length' => $request->length,
            'weigth' => $request->weigth,
            'temperature' => $request->temperature,
        ]);

        # save biometric record
        if ($note->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet])->with('set_active_tab', __('biometrics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet, Biometric $biometric)
    {
        # biometrics
        $biometric->user_id = auth()->user()->id;
        $biometric->heigth = $request->heigth;
        $biometric->length = $request->length;
        $biometric->weigth = $request->weigth;
        $biometric->temperature = $request->temperature;

        if ($biometric->save()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }


        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet])->with('set_active_tab', __('biometrics'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biometric $biometric)
    {
        //
    }
}
