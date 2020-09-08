<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Clinic;
use App\Pet;
use App\Problem;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;


class PrescriptionController extends Controller
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
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }


    public function list(Clinic $clinic, Pet $pet, $problem_id = null, $return = null)
    {
        // dd('nanna: ' . $problem_id);
        $query = Prescription::where('prescriptions.pet_id', '=', $pet->id)
            ->join('medicines', 'prescriptions.medicine_id', '=', 'medicines.id')
            ->select('prescriptions.*', 'medicines.name')
            ->orderBy('created_at', 'desc')
            ->orderBy('in_evidence', 'desc');

        if($problem_id > 0){
            $query->where('problem_id', '=', $problem_id);
        }
        $prescriptions = $query->get();
        // dd($prescriptions);

        if ($return == 'datatable') {
            return Datatables::of($prescriptions)
                ->make(true);
        }
    }
}
