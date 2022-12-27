<?php

namespace App\Http\Controllers;

use App\Models\Ozzy;
use Illuminate\Http\Request;

class OzzyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "nanna";
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
     * @param  \App\Models\Ozzy  $ozzy
     * @return \Illuminate\Http\Response
     */
    public function show(Ozzy $ozzy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ozzy  $ozzy
     * @return \Illuminate\Http\Response
     */
    public function edit(Ozzy $ozzy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ozzy  $ozzy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ozzy $ozzy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ozzy  $ozzy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ozzy $ozzy)
    {
        //
    }
}
