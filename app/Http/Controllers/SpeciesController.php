<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        $species = Species::where('clinic_id', '=', $clinic->id)->get();
        return view('species.index')->with('clinic', $clinic)->with('species', $species);
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
    public function store(Request $request, Clinic $clinic)
    {
        $request->validate([
            'tsn' => 'required',
            'familiar_name' => 'required|max:255',
        ]);

        $species = new Species();
        $species->tsn = $request->tsn;
        $species->clinic_id = $clinic->id;
        $species->familiar_name = $request->familiar_name;

        try {
            $species->save();
            return redirect()->route('clinics.species.index', $clinic)->with('success', __('message.species_store_success'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('clinics.species.index', $clinic)->with('error', __('message.species_store_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Species $species)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Species $species)
    {
        // validate
        $request->validate([
            'familiar_name' => 'required|max:255',
        ]);

        $species->familiar_name = $request->familiar_name;

        $species->save();
        try {
            return redirect()->route('clinics.species.index', $clinic)->with('success', __('message.specie_update_success'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('clinics.species.index', $clinic)->with('error', __('message.specie_update_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Species $species)
    {
        $species->delete();
        return redirect()->route('clinics.species.index', $clinic)->with('success', __('message.clinic_destroy_success'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request, Clinic $clinic, Species $species)
    {
        $response = array(
            "id" => $species->id,
            "tsn" => $species->tsn,
            "complete_name" => $species->animalia()->first()->complete_name,
            "familiar_name" => $species->familiar_name
        );

        echo json_encode($response);
        exit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Clinic $clinic, Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $species = Species::where('clinic_id', '=', $clinic->id)->orderby('familiar_name', 'asc')->select('id', 'familiar_name')->limit(5)->get();
        } else {
            $species = Species::where('clinic_id', '=', $clinic->id)->where('familiar_name', 'like', '%' . $search . '%')->orderby('familiar_name', 'asc')->select('id', 'familiar_name')->limit(5)->get();
        }

        $response = array();
        foreach ($species as $specie) {
            $response[] = array(
                "id" => $specie->id,
                "text" => $specie->familiar_name
            );
        }

        echo json_encode($response);
        exit;
    }
}
