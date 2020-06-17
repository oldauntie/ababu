<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Mail\ClinicJoinMail;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Country;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('clinics.create')->with('countries', $countries);
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
            'country_id' => $request->get('country_id'),
            'name' => $request->get('name'),
            'serial' => Str::random(8),
            'key' => Str::random(8),
            'description' => $request->get('description'),
        ]);
        $clinic->save();

        $imageName = null;
        if ($request->file('logo')) {
            $imagePath = $request->file('logo');
            $imageName =  'veterinaty-clinic-logo-' . $clinic->id . '-' . Str::random(8) . '.' . $imagePath->getClientOriginalExtension();

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
        return view('clinics.edit')->with('clinic', $clinic);
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
        // validate
        $request->validate([
            'name' => 'required|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $clinic->name = $request->name;
        $clinic->description = $request->description;

        $imageName = null;
        if ($request->file('logo')) {
            $imagePath = $request->file('logo');
            $imageName =  'veterinaty-clinic-logo-' . $clinic->id . '-' . Str::random(8) . '.' . $imagePath->getClientOriginalExtension();

            $request->logo->move(public_path('images'), $imageName);
            
            // delete previous file if exists
            if($clinic->logo != null && file_exists(public_path('images'). '/'. $clinic->logo))
            {
                unlink(public_path('images'). '/'. $clinic->logo);
            }
            $clinic->logo = $imageName;
        }

        if ($clinic->save()) {
            $request->session()->flash('success', __('message.clinic_update_success'));
        } else {
            $request->session()->flash('error', 'message.clinic_update_error');
        }
        
        return redirect()->route('clinics.show', $clinic);
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
        // split the token and compose serial / key attributes 
        $aToken = explode('-', $request->token);
        $serial = $aToken[0];
        $handshakeRequest = $aToken[1];

        // load a clinic object
        $clinic = Clinic::where('serial', $serial)->first();

        if ($clinic == null) {
            $request->session()->flash('error', __('message.clinic_join_not_found'));
        } else {
            if ($clinic->users->where('id', Auth::user()->id)->count() > 0) {
                $request->session()->flash('error', __('message.clinic_join_user_exists'));
            } else {
                // user doen not exists. check the hanshake
                $handshakeResponse = substr(md5(Auth::user()->email . $clinic->key), 0, 8);
                if($handshakeRequest === $handshakeResponse){
                    $veterinarianRole = Role::where('name', 'veterinarian')->first();
                    $clinic->roles()->attach($veterinarianRole, ['user_id' => Auth::user()->id]);
                    
                    $request->session()->flash('success', __('message.clinic_join_success'));
                }else{
                    $request->session()->flash('error', __('message.clinic_join_error'));
                }
            }
        }
        return redirect()->route('home');
    }

    public function invite($clinic){
        
        return view('clinics.invite')->with('clinic', $clinic);



    }


    /**
     * Send invitation to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request, Clinic $clinic)
    {
        // validate email address
        $request->validate([
            // email must exists in user table
            // 'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        Mail::to($request->email)->send(new ClinicJoinMail($clinic));
        
        return redirect()->route('clinics.show', $clinic)->with('success', __('message.clinic_invitation_success'));
    }
}
