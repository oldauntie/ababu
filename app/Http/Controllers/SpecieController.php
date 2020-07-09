<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Specie;
use App\Life;
use Illuminate\Http\Request;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clinic_id)
    {
        $species = Specie::all();
        // $species = Specie::leftJoin('lives', 'species.tsn', '=', 'lives.tsn')->get();
        $clinic = Clinic::findOrFail($clinic_id);
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
    public function store(Request $request, $clinic_id)
    {
        $request->validate([
            'tsn' => 'required',
            'familiar_name' => 'required|max:255',
        ]);

        $specie = new Specie();
        $specie->tsn = $request->tsn;
        $specie->clinic_id = $clinic_id;
        $specie->familiar_name = $request->familiar_name;

        $clinic = Clinic::findOrFail($clinic_id);

        try {
            $specie->save();
            return redirect()->route('species.index', $clinic)->with('success', __('message.specie_create_success'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('species.index', $clinic)->with('error', __('message.specie_create_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function show(Specie $specie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function edit(Specie $specie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clinic_id, $specie_id)
    {
        // validate
        $request->validate([
            'familiar_name' => 'required|max:255',
        ]);

        $clinic = Clinic::find($clinic_id);
        $specie = Specie::find($specie_id);


        $specie->familiar_name = $request->familiar_name;

        try {
            $specie->save();
            return redirect()->route('species.index', $clinic)->with('success', __('message.specie_edit_success'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('species.index', $clinic)->with('error', __('message.specie_edit_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specie $specie)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $id = $request->id;

        $specie = Specie::find($id)->first();

        $response = array(
            "tsn" => $specie->tsn,
            "complete_name" => $specie->life()->first()->complete_name,
            "familiar_name" => $specie->familiar_name
        );

        echo json_encode($response);
        exit;
    }
}
