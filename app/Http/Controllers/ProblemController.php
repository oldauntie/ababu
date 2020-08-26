<?php

namespace App\Http\Controllers;

use App\Problem;
use App\Clinic;
use App\Pet;
use App\Diagnosis;

use Illuminate\Http\Request;

class ProblemController extends Controller
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
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        //
    }

    public function get(Clinic $clinic, Problem $problem)
    {
        $result = $problem->toArray();

        // formatting dates
        /*
        $result['date_of_birth'] = $pet->date_of_birth->format($locale->date_short_format);
        $result['date_of_death'] = $pet->date_of_death != null ? $pet->date_of_death->format($locale->date_short_format) : null;
        $result['created_at'] = $pet->created_at ? $pet->created_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;
        $result['updated_at'] = $pet->updated_at ? $pet->updated_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;

        $result += ['species' => $pet->species->toArray()];
        $result += ['owner' => $pet->owner->toArray()];
        */

        return response()->json($result);
    }


    public function getProblemByDiagnosis(Clinic $clinic, Diagnosis $diagnosis, Pet $pet)
    {
        $problem = Problem::where('diagnosis_id', '=', $diagnosis->id)
            ->where('pet_id', '=', $pet->id)
            ->first();


        if ($problem == null) {
            $problem = new Problem();
            $problem->diagnosis_id = $diagnosis->id;
        }
        $result = $problem->toArray();
        
        // dd($problem);
        // dd($result);
        return response()->json($result);
    }
}
