<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Note;
use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Http\Request;

class NoteController extends Controller
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
    public function create(Clinic $clinic, Owner $owner, Pet $pet)
    {
        return view('pets.visits.notes.create')
            ->with('clinic', $clinic)
            ->with('owner', $owner)
            ->with('pet', $pet);
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
            'subjective' => 'required',
            'objective' => 'required',
            'assessment' => 'required',
            'plan' => 'required',
        ]);


        $note = new Note([
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'subjective' => $request->subjective,
            'objective' => $request->objective,
            'assessment' => $request->assessment,
            'plan' => $request->plan,
        ]);

        # save note record
        if ($note->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        $request->session()->flash('set_active_tab', 'notes');
        return redirect()->route('clinics.owners.pets.show', [$clinic, $owner, $pet]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic, Owner $owner, Pet $pet, Note $note)
    {
        return view('pets.visits.notes.edit')
            ->with('clinic', $clinic)
            ->with('owner', $owner)
            ->with('pet', $pet)
            ->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @param  \App\Models\Owner  $owner
     * @param  \App\Models\Pet  $pet
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet, Note $note)
    {
        $request->validate([
            'subjective' => 'required',
            'objective' => 'required',
            'assessment' => 'required',
            'plan' => 'required',
        ]);

        # fill note information
        $note->subjective = $request->subjective;
        $note->objective = $request->objective;
        $note->assessment = $request->assessment;
        $note->plan = $request->plan;

        # update note info
        if ($note->update()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }

        $request->session()->flash('set_active_tab', 'notes');
        return redirect()->route('clinics.owners.pets.show', [$clinic, $owner, $pet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
