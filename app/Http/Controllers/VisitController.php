<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Clinic;
use App\Note;
use App\Pet;
use App\Prescription;
use App\Problem;
use App\Watchdog;
use PDF;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        return view('visits.index')->with('clinic', $clinic);
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
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Pet $pet)
    {
        $problems = Problem::where('pet_id', '=', $pet->id)
                    ->orderBy('status_id', 'desc')    
                    ->get();

        $prescriptions = Prescription::where('pet_id', '=', $pet->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        $notes = Note::where('pet_id', '=', $pet->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        

        Watchdog::write($clinic, 'visit', Watchdog::WATCHDOG_INFO, NULL, ['pet' => $pet, 'owner' => $pet->owner]);


        return view('visits.show')
                ->with('clinic', $clinic)
                ->with('problems', $problems)
                ->with('prescriptions', $prescriptions)
                ->with('notes', $notes)
                ->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        //
    }

    // @tbe @todo: modify to print a visit summary
    public function print(Clinic $clinic, Pet $pet)
    {
        $data = ['title' => 'nanna !!'];
        $pdf = PDF::loadView('visits.print', $data);

        return $pdf->download('visti_summary.pdf');
        return $pdf->stream();
    }
}
