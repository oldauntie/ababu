<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Diagnosis;
use App\Models\Owner;
use App\Models\Pet;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PetController extends Controller
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
    public function create(Clinic $clinic, Owner $owner)
    {
        return view('pets.create')->with('clinic', $clinic)->with('owner', $owner);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Clinic $clinic, Owner $owner)
    {
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'max:100',
            'distinguishing_mark' => 'max:100',
            'species_id' => 'required',
            'sex' => 'required|max:1',
            'date_of_birth' => 'required|before:tomorrow',
            'date_of_death' => 'nullable|after_or_equal:date_of_birth|before:tomorrow',
        ]);

        $pet = new Pet([
            // 'clinic_id' => $clinic->id,
            'species_id' => $request->get('species_id'),
            'owner_id' => $owner->id,
            'breed' => $request->get('breed'),
            'name' => $request->get('name'),
            'sex' => $request->get('sex'),
            'date_of_birth' => $request->get('date_of_birth'),
            'date_of_death' => $request->get('date_of_death'),
            'description' => $request->get('description'),
            'color' => $request->get('color'),
            'distinguishing_mark' => $request->get('distinguishing_mark'),
            'reproductive_status' => $request->get('reproductive_status'),
            'life_style' => $request->get('life_style'),
            'microchip' => $request->get('microchip'),
            'microchip_location' => $request->get('microchip_location'),
            'tatuatge' => $request->get('tatuatge'),
            'tatuatge_location' => $request->get('tatuatge_location'),
        ]);

        # save pet record
        $pet->save();

        # create a medical history record
        $pet->medical_history()->create();


        if ($pet->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.show', [$clinic, $owner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Owner $owner, Pet $pet)
    {
        // @todo: optimize and localise
        $diagnoses = Diagnosis::all();
        
        return view('pets.show')
            ->with('clinic', $clinic)
            ->with('diagnoses', $diagnoses)
            ->with('owner', $owner)
            ->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic, Owner $owner, Pet $pet)
    {
        return view('pets.edit')
            ->with('clinic', $clinic)
            ->with('owner', $owner)
            ->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet)
    {
        $request->validate([
            'name' => 'sometimes|required|max:255',
            'color' => 'sometimes|max:100',
            'distinguishing_mark' => 'sometimes|max:100',
            'species_id' => 'sometimes|required',
            'sex' => 'sometimes|required|max:1',
            'date_of_birth' => 'sometimes|required|before:tomorrow',
            'date_of_death' => 'sometimes|nullable|after_or_equal:date_of_birth|before:tomorrow',
        ]);


        # fill pet information
        $pet->species_id = $request->species_id;
        $pet->owner_id = $owner->id;
        $pet->breed = $request->breed;
        $pet->name = $request->name;
        $pet->sex = $request->sex;
        $pet->date_of_birth = $request->date_of_birth;
        $pet->date_of_death = $request->date_of_death;
        $pet->description = $request->description;
        $pet->color = $request->color;
        $pet->distinguishing_mark = $request->distinguishing_mark;
        $pet->microchip = $request->microchip;
        $pet->microchip_location = $request->microchip_location;
        $pet->tatuatge = $request->tatuatge;
        $pet->tatuatge_location = $request->tatuatge_location;

        $pet->owner_id = $owner->id;

        # update pet info
        if ($pet->update()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }


        return redirect()->route('clinics.owners.pets.show', [$clinic, $owner, $pet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Owner $owner, Pet $pet)
    {
        $pet->delete();
        return redirect()->route('clinics.owners.show', [$clinic, $owner])->with('success', __('message.record_destroy_success'));
    }
}
