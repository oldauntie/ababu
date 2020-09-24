<?php

namespace App\Http\Controllers;

use App\Note;
use App\Clinic;
use App\Pet;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'note_text' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $pet])
            ->withErrors($validator);
        }

        $note = new Note([
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'note_text' => $request->note_text,
        ]);

        if ($note->save())
        {
            $request->session()->flash('success', __('message.note_create_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.note_store_error');
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Pet $pet, Note $note)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'note_text' => 'required',
        ]);

        
        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $note->pet_id])
            ->withErrors($validator);
        }
        
        $note->user_id = auth()->user()->id;
        $note->note_text = $request->note_text;
        

        if ($note->save())
        {
            $request->session()->flash('success', __('message.note_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.note_update_error');
        }

        return redirect()->route('clinics.visits.show', [$clinic, $pet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Pet $pet, Note $note)
    {
        if($note->delete())
        {
            Session::flash('success', __('message.note_destroy_success'));
        }
        else
        {
            Session::flash('success', __('message.note_destroy_error'));
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet]);
    }
}
