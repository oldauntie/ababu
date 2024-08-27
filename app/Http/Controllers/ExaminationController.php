<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Examination;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;

class ExaminationController extends Controller
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
    public function store(Request $request, Clinic $clinic, Owner $owner, Pet $pet)
    {
        $request->validate([
            'diagnostic_test_id' => 'required',
            'examination_date' => 'required|before:tomorrow',
        ]);

        $examination = new Examination([
            'diagnostic_test_id' => $request->diagnostic_test_id,
            'pet_id' => $pet->id,
            'problem_id' => $request->problem_id,
            'user_id' => auth()->user()->id,
            'examination_date' => $request->examination_date,
            'result' => $request->result,
            'meddical_report' => $request->meddical_report,
            'is_pathologic' => $request->has('is_pathologic'),
            'in_evidence' => $request->has('in_evidence'),
            'notes' => $request->notes,
            'print_notes' => $request->has('print_notes'),
        ]);

        # save note record
        if ($examination->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $examination->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function show(Examination $examination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function edit(Examination $examination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examination $examination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examination $examination)
    {
        //
    }
}
