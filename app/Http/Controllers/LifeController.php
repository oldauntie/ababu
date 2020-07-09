<?php

namespace App\Http\Controllers;

use App\Life;
use Illuminate\Http\Request;

class LifeController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Life  $life
     * @return \Illuminate\Http\Response
     */
    public function show(Life $life)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Life  $life
     * @return \Illuminate\Http\Response
     */
    public function edit(Life $life)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Life  $life
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Life $life)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Life  $life
     * @return \Illuminate\Http\Response
     */
    public function destroy(Life $life)
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
