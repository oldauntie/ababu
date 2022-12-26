<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Clinic;
use App\Owner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Gate;


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
    public function store(Request $request, Clinic $clinic)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'sex' => 'required|max:1',
            'date_of_birth' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->getMessageBag()->add('action_pet_store', 'Errors on Store');

            return redirect()->route('clinics.pets.index', [$clinic])
                ->withErrors($validator)
                ->withInput();
        }

        $pet = new Pet([
            'clinic_id' => $clinic->id,
            'species_id' => $request->get('species_id'),
            'owner_id' => $request->get('owner_id'),
            'breed' => $request->get('breed'),
            'name' => $request->get('name'),
            'sex' => $request->get('sex'),
            'date_of_birth' => Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->get('date_of_birth') ),
            'date_of_death' => $request->get('date_of_death') != null ? Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->get('date_of_death') ) : null,
            'description' => $request->get('description'),
            'color' => $request->get('color'),
            'microchip' => $request->get('microchip'),
            'microchip_location' => $request->get('microchip_location'),
            'tatuatge' => $request->get('tatuatge'),
            'tatuatge_location' => $request->get('tatuatge_location'),
        ]);

        $pet->save();

        if ($pet->save()) {
            $request->session()->flash('success', __('message.pet_create_success'));
        } else {
            $request->session()->flash('error', 'message.pet_store_error');
        }

        return redirect()->route('clinics.pets.index', [$clinic, $pet]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'sex' => 'required|max:1',
            'date_of_birth' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->getMessageBag()->add('pet_id', $pet->id);

            return redirect()->route('clinics.pets.index', [$clinic])
                ->withErrors($validator);
        }
        
        $pet->clinic_id = $clinic->id;
        $pet->species_id = $request->species_id;
        $pet->owner_id = $request->owner_id;
        $pet->breed = $request->breed;
        $pet->name = $request->name;
        $pet->sex = $request->sex;
        $pet->date_of_birth = Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->date_of_birth);
        $pet->date_of_death = $request->date_of_death == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->date_of_death);
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
        $result['date_of_death'] = $pet->date_of_death != null ? $pet->date_of_death->format($locale->date_short_format) : null;
        $result['created_at'] = $pet->created_at ? $pet->created_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;
        $result['updated_at'] = $pet->updated_at ? $pet->updated_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;

        $result += ['species' => $pet->species->toArray()];
        $result += ['owner' => $pet->owner->toArray()];

        return response()->json($result);
    }
}
