<?php

namespace App\Http\Controllers;

use App\Problem;
use App\Clinic;
use App\Pet;
use App\Diagnosis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request, Clinic $clinic, Pet $pet)
    {
        // validate
        // validate
        $validator = Validator::make($request->all(), [
            'status_id' => 'required',
            'active_from' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic])
                ->withErrors($validator);
        }


        $problem = new Problem([
            'diagnosis_id' => $request->diagnosis_id,
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'status_id' => $request->status_id,
            'active_from' => Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->active_from),
            'key_problem' => $request->key_problem == 1 ? true : false,
            // 'date_of_death' => $request->get('date_of_death') != null ? Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->get('date_of_death') ) : null,
            'subjective_analysis' => $request->subjective_analysis,
            'objective_analysis' => $request->objective_analysis,
            'notes' => $request->notes,
        ]);


        if ($problem->save())
        {
            $request->session()->flash('success', __('message.problem_create_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.problem_store_error');
        }
        return redirect()->route('clinics.visits.show', [$clinic, $problem->pet_id]);
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
    public function update(Request $request, Clinic $clinic, Pet $pet, Problem $problem)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'status_id' => 'required',
            'active_from' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $problem->pet_id])
                ->withErrors($validator);
        }

        // $problem->diagnosis_id = $request->diagnosis_id;
        $problem->user_id = auth()->user()->id;
        $problem->status_id = $request->status_id;
        $problem->active_from = Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->active_from);
        $problem->key_problem = $request->key_problem == null ? false : true;
        $problem->subjective_analysis = $request->subjective_analysis;
        $problem->objective_analysis = $request->objective_analysis;
        $problem->notes = $request->notes;

        // dd($problem);

        if ($problem->save())
        {
            $request->session()->flash('success', __('message.problem_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.problem_update_error');
        }

        return redirect()->route('clinics.visits.show', [$clinic, $problem->pet_id]);
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

        /*
        $result += ['species' => $pet->species->toArray()];
        $result += ['owner' => $pet->owner->toArray()];
        */

        return response()->json($result);
    }


    public function getProblemByDiagnosis(Clinic $clinic, Pet $pet, Diagnosis $diagnosis)
    {
        // load user locale
        $locale = auth()->user()->locale;

        $problem = Problem::where('diagnosis_id', '=', $diagnosis->id)
            ->where('pet_id', '=', $pet->id)
            ->first();

        // create a new problem if is null
        if ($problem == null)
        {
            $problem = new Problem();
            $problem->diagnosis_id = $diagnosis->id;
            $problem->active_from = Carbon::now();
        }
        $result = $problem->toArray();

        // change date format
        $result['active_from'] = $problem->active_from->format($locale->date_short_format);

        // add diagnosis to results
        $result += ['diagnosis' => $problem->diagnosis->toArray()];

        return response()->json($result);
    }
}
