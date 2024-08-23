<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\MedicalHistory;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet)
    {
        /*
        $request->validate([
            'previous_diseases' => 'required|max:2',
        ]);
        */
        # medical history
        $pet->medical_history->reproductive_status = $request->reproductive_status;
        $pet->medical_history->life_style = $request->life_style;
        $pet->medical_history->has_pets_in_house = $request->has('has_pets_in_house');
        $pet->medical_history->has_children_in_house = $request->has('has_children_in_house');
        $pet->medical_history->food = $request->food;
        $pet->medical_history->food_consumption = $request->food_consumption;
        $pet->medical_history->water_consumption = $request->water_consumption;
        $pet->medical_history->previous_diseases = $request->previous_diseases;
        $pet->medical_history->previous_surgery = $request->previous_surgery;
        $pet->medical_history->flea_preventive = $request->flea_preventive;
        $pet->medical_history->tick_preventive = $request->tick_preventive;
        $pet->medical_history->heartworm_preventive = $request->heartworm_preventive;

        if ($pet->medical_history->save()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }


        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet])->with('set_active_tab', __('medical-history'));
    }
}
