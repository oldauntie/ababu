<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Problem;
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
    public function store(Request $request, Clinic $clinic, Owner $owner, Pet $pet, Problem $problem)
    {
        $request->validate([
            'color' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'active_from' => 'required|before:tomorrow',
        ]);

        $is_key_problem = $request->has('key_problem') ? true : false;

        $problem = new Problem([
            'diagnosis_id' => $request->diagnosis_id,
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'status_id' => $request->status_id,
            'active_from' => $request->active_from,
            'key_problem' => $is_key_problem,
            'description' => $request->description,
            'notes' => $request->notes,
            'color' => $request->color,
        ]);

        if ($problem->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic, Owner $owner, Pet $pet, Problem $problem)
    {
        return view('visits.problems.edit')
            ->with('clinic', $clinic)
            ->with('owner', $owner)
            ->with('pet', $pet)
            ->with('problem', $problem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @param  \App\Models\Owner  $owner
     * @param  \App\Models\Pet  $pet
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet, Problem $problem)
    {
        $request->validate([
            'description' => 'required',
            'status_id' => 'required',
            'active_from' => 'required',
        ]);

        $is_key_problem = $request->has('key_problem') ? true : false;

        $problem->status_id = $request->status_id;
        $problem->active_from = $request->active_from;
        $problem->key_problem = $is_key_problem;
        $problem->description = $request->description;
        $problem->notes = $request->notes;
        $problem->color = $request->color;

        if ($problem->update()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        //
    }



    /**
     * Display a listing of possible problems (VeNom).
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Clinic $clinic)
    {
        $search = $request->search;

        if ($search == '') {
            $medicines = Medicine::where('country_id', '=', $clinic->country_id)->orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $medicines = Medicine::where('country_id', '=', $clinic->country_id)->orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($medicines as $medicine) {
            $response[] = array(
                "id" => $medicine->id,
                "text" => $medicine->name
            );
        }

        echo json_encode(["results" => $response]);

        exit;
    }
}
