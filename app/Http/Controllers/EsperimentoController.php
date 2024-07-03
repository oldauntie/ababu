<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Esperimento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EsperimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # $password = Hash::make('some_password_here');
        # echo $password;

        $dia = Diagnosis::select(['diagnoses.id', 'diagnoses.term_name', DB::raw('count(problems.id) as active')])
            ->leftJoin('problems', 'problems.diagnosis_id', '=', 'diagnoses.id')
            ->groupBy('diagnoses.id')
            ->toSql();


        $dia = Diagnosis::select(['diagnoses.id', 'diagnoses.term_name', DB::raw('count(problems.id) as active')])
            ->leftJoin('problems', 'problems.diagnosis_id', '=', DB::raw('diagnoses.id AND problems.pet_id = ' . $pet->id))
            ->groupBy('diagnoses.id')
            ->toSql();
        // ->get();
        
        dump($dia);



        return view('esperimenti.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Esperimento $esperimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Esperimento $esperimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Esperimento $esperimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Esperimento $esperimento)
    {
        //
    }
}
