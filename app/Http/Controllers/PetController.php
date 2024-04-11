<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
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
            'species_id' => 'required',
        ]);

        $pet = new Pet([
            'clinic_id' => $clinic->id,
            'species_id' => $request->get('species_id'),
            'owner_id' => $owner->id,
            'breed' => $request->get('breed'),
            'name' => $request->get('name'),
            'sex' => $request->get('sex'),
            'date_of_birth' => $request->get('date_of_birth'),
            'date_of_death' => $request->get('date_of_death'),
            'description' => $request->get('description'),
            'color' => $request->get('color'),
            'microchip' => $request->get('microchip'),
            'microchip_location' => $request->get('microchip_location'),
            'tatuatge' => $request->get('tatuatge'),
            'tatuatge_location' => $request->get('tatuatge_location'),
        ]);

        $pet->save();

        if ($pet->save()) {
            $request->session()->flash('success', __('message.pet_store_success'));
        } else {
            $request->session()->flash('error', 'message.pet_store_error');
        }

        return redirect()->route('clinics.owners.show', [$clinic, $owner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic, Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
