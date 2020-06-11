<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $clinic = new Clinic([
            'name' => $request->get('name'),
            'token' => Str::random(8),
            'description' => $request->get('description'),
        ]);
        $clinic->save();

        $imageName = null;
        if ($request->file('logo')) {
            $imagePath = $request->file('logo');
            $imageName =  'veterinaty-clinic-logo-' . $clinic->id . '-' . Str::random(8) . '.' . $imagePath->getClientOriginalExtension();

            // $path = $request->file('logo')->storeAs('/uploads', $imageName, 'public');
            $request->logo->move(public_path('images'), $imageName);
        }
        $clinic->logo = $imageName;
        $clinic->save();

        $veterinarianRole = Role::where('name', 'admin')->first();
        $clinic->roles()->attach($veterinarianRole, ['user_id' => Auth::user()->id]);


        return redirect('/home')->with('success', __('message.clinic_create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        return view('clinics.show')->with('clinic', $clinic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        //
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {
        $clinic = Clinic::where('token', $request->token)->first();

        if ($clinic == null) {
            $request->session()->flash('error', __('message.clinic_join_not_found'));
        } else {
            if ($clinic->users->where('id', Auth::user()->id)->count() > 0) {
                $request->session()->flash('error', __('message.clinic_join_user_exists'));
            } else {
                $veterinarianRole = Role::where('name', 'veterinarian')->first();
                $clinic->roles()->attach($veterinarianRole, ['user_id' => Auth::user()->id]);

                $request->session()->flash('success', __('message.clinic_join_success'));
            }
        }
        return redirect()->route('home');
    }
}
