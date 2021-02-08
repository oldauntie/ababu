<?php

namespace App\Http\Controllers;

use App\Treatment;
use App\Clinic;
use App\Pet;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TreatmentController extends Controller
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
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Pet $pet, Treatment $treatment)
    {
        
        $treatment->procedure_id = $request->procedure_id;
        $treatment->pet_id = $pet->id;
        $treatment->user_id = auth()->user()->id;
        

        
        $treatment->recall_at = $request->recall_at == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->recall_at);
        $treatment->notes = $request->notes;
        $treatment->print_notes = $request->print_notes == null ? false : true;
        
        
        if ($treatment->save())
        {
            $request->session()->flash('success', __('message.treatment_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.treatment_update_error');
        }

        return redirect()->route('clinics.visits.show', [$clinic, $pet->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        //
    }


    public function editTreatmentById(Clinic $clinic, Pet $pet, Treatment $treatment)
    {
        // load user locale
        $locale = auth()->user()->locale;

        $result = $treatment->toArray();
        
        // change date format
        $result['created_at'] = $treatment->created_at != null ? $treatment->created_at->format($locale->date_medium_format . " " . $locale->time_long_format) : null;
        $result['updated_at'] = $treatment->updated_at != null ? $treatment->updated_at->format($locale->date_medium_format . " " . $locale->time_long_format) : null;
        $result['created_at_short_format'] = $treatment->created_at != null ? $treatment->created_at->format($locale->date_short_format) : null;
        $result['recall_at'] = $treatment->recall_at != null ? $treatment->recall_at->format($locale->date_short_format) : null;

        // add procedure to results
        $result += ['procedure' => $treatment->procedure->toArray()];

        return response()->json($result);
    }



    public function list(Clinic $clinic, Pet $pet, $problem_id = null, $return = null)
    {
        $query = Treatment::where('treatments.pet_id', '=', $pet->id)
            ->join('procedures', 'treatments.procedure_id', '=', 'procedures.id')
            ->select('treatments.*', 'procedures.term_name')
            ->orderBy('created_at', 'desc');

        $treatments = $query->get();

        if ($return == 'datatable')
        {
            return Datatables::of($treatments)
                ->make(true);
        }
    }


    
}
