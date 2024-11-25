<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Diagnosis;
use App\Models\Esperimento;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // dump(Auth::user());
        // dump(User::with('setting')->get());
        // dd(Auth::user()->setting);

        // return view('esperimenti.index');


        $data = [
            'clinic'     => '1',
            'detailemployee' => '10',
            'detailservice'  => '30'
        ];
        $pdf = Pdf::loadView('esperimenti.print', $data);
        return $pdf->stream();
        # return $pdf->download('invoice.pdf');
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
