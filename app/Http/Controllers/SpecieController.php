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

        $clinic = Clinic::findOrFail($clinic_id);
        return view('species.index')->with('clinic', $clinic);
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
    public function update(Request $request, Specie $specie)
    {
        //
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

    public function ajax(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $species = Life::orderby('complete_name', 'asc')->select('tsn', 'complete_name')->limit(5)->get();
        } else {
            $species = Life::orderby('complete_name', 'asc')->select('tsn', 'complete_name')->where('complete_name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($species as $specie) {
            $response[] = array(
                "id" => $specie->tsn,
                "text" => $specie->complete_name
            );
        }

        echo json_encode($response);
        exit;
    }
}
