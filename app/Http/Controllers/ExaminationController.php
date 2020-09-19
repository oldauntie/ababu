<?php

namespace App\Http\Controllers;

use App\Examination;
use App\Clinic;
use App\Pet;
use App\Problem;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function show(Examination $examination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Examination  $examination
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
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examination $examination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examination $examination)
    {
        //
    }

    public function list(Clinic $clinic, Pet $pet, $problem_id = null, $return = null)
    {
        $query = Examination::where('examinations.pet_id', '=', $pet->id)
            // ->join('medicines', 'prescriptions.medicine_id', '=', 'medicines.id')
            // ->select('examinations.*', 'medicines.name')
            ->orderBy('in_evidence', 'desc')
            ->orderBy('created_at', 'desc');

        if ($problem_id != null && $problem_id > 0)
        {
            $query->where('problem_id', '=', $problem_id);
        }
        $examinations = $query->get();

        if ($return == 'datatable')
        {
            return Datatables::of($examinations)
                ->make(true);
        }
    }
}
