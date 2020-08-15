<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Clinic;
use App\Owner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clinic $clinic)
    {
        return view('pets.index')->with('clinic', $clinic);
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
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Pet $pet)
    {
        // validate
        $request->validate([
            'name' => 'required|max:255',
            'sex' => 'required|max:1',
            'date_of_birth' => 'required',
        ]);
        // dd($request);

        $pet->species_id = $request->species_id;

        $pet->clinic_id = $clinic->id;
        $pet->owner_id = $request->owner_id;
        $pet->name = $request->name;
        $pet->sex = $request->sex;
        $pet->date_of_birth = Carbon::createFromFormat("d/m/Y", $request->date_of_birth);
        $pet->date_of_death = $request->date_of_death == null ? null : Carbon::createFromFormat("d/m/Y", $request->date_of_death);
        $pet->description = $request->description;
        $pet->color = $request->color;
        $pet->microchip = $request->microchip;
        $pet->microchip_location = $request->microchip_location;
        $pet->tatuatge = $request->tatuatge;
        $pet->tatuatge_location = $request->tatuatge_location;

        if ($pet->save()) {
            $request->session()->flash('success', __('message.pet_update_success'));
        } else {
            $request->session()->flash('error', 'message.pet_update_error');
        }

        return redirect()->route('clinics.pets.index', [$clinic, $pet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Pet $pet)
    {
        $pet->delete();
        return redirect()->route('clinics.pets.index', $clinic->id)->with('success', __('message.pet_destroy_success'));
    }


    public function list(Clinic $clinic, $return = null)
    {
        $pets = Pet::where('pets.clinic_id', '=', $clinic->id)
            ->join('species', 'pets.species_id', '=', 'species.id')
            ->join('owners', 'pets.owner_id', '=', 'owners.id')
            ->select('pets.*', 'owners.firstname', 'owners.lastname', 'species.familiar_name')
            ->get();

        if ($return == 'datatable') {
            return Datatables::of($pets)
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="pet-visit-button"><button type="button" class="btn btn-sm btn-dark float-left">' . __('translate.visit') . '</button></a>'
                        . '<a href="#" class="pet-edit-button"><button type="button" class="btn btn-sm btn-secondary float-left">' . __('translate.edit') . '</button></a>'
                        . '<a href="#" class="pet-delete-button"><button type="button" class="btn btn-sm btn-danger float-left">' . __('translate.delete') . '</button></a>';;
                })
                ->make(true);
        }
    }


    public function listByOwner(Clinic $clinic, Owner $owner, $return = null)
    {
        $pets = Pet::where('clinic_id', '=', $clinic->id)
            ->where('owner_id', '=', $owner->id)
            ->get();

        if ($return == 'datatable') {
            return Datatables::of($pets)
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="pet-visit-button"><button type="button" class="btn btn-sm btn-dark float-left">' . __('translate.visit') . '</button></a>';
                })
                ->make(true);
        }
    }

    public function get(Clinic $clinic, Pet $pet)
    {
        $locale = auth()->user()->locale;
        $result = $pet->toArray();
        // formatting dates
        $result['date_of_birth'] = $pet->date_of_birth->format($locale->date_short_format);
        $result['date_of_death'] = $pet->date_of_birth->format($locale->date_short_format);
        $result['created_at'] = $pet->created_at ? $pet->created_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;
        $result['updated_at'] = $pet->updated_at ? $pet->updated_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;
        
        $result += ['species' => $pet->species->toArray()];
        $result += ['owner' => $pet->owner->toArray()];

        

        return response()->json($result);
    }
}
