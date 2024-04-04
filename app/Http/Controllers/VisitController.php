<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Pet;
use App\Models\Problem;
use App\Models\Visit;
use App\Models\Watchdog;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('visit.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinic $clinic, Pet $pet)
    {
        $problems = Problem::where('pet_id', '=', $pet->id)
                    ->orderBy('status_id', 'desc')    
                    ->get();

        Watchdog::write($clinic, 'visit', Watchdog::WATCHDOG_INFO, NULL, ['pet' => $pet, 'owner' => $pet->owner]);


        return view('visits.show')
                ->with('clinic', $clinic)
                ->with('problems', $problems)
                ->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
