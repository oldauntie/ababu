<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Mail\ClinicJoinMail;
use App\Role;
use App\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Country;
use App\Watchdog;

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
        $countries = Country::where('enabled', '=', true)->get();
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
            'manager' => $request->get('manager'),
            'code' => $request->get('code'),
            'address' => $request->get('address'),
            'postcode' => $request->get('postcode'),
            'city' => $request->get('city'),
            'phone' => $request->get('phone'),
            'website' => $request->get('website'),
            'email' => $request->get('email'),
        ]);
        $clinic->save();

        $imageName = null;
        if ($request->file('logo'))
        {
            $imagePath = $request->file('logo');
            $imageName =  'veterinary-clinic-logo-' . $clinic->id . '-' . Str::random(8) . '.' . $imagePath->getClientOriginalExtension();

            $request->logo->move(public_path('images'), $imageName);
        }
        $clinic->logo = $imageName;
        $clinic->save();

        $adminRole = Role::where('name', 'admin')->first();
        $clinic->roles()->attach($adminRole, ['user_id' => Auth::user()->id]);

        if ($request->has('species_add_common'))
        {
            Species::create(['tsn' => '726821', 'clinic_id' => $clinic->id, 'familiar_name' => __('translate.species_dog')]);
            Species::create(['tsn' => '183798', 'clinic_id' => $clinic->id, 'familiar_name' => __('translate.species_cat')]);
            Species::create(['tsn' => '180691', 'clinic_id' => $clinic->id, 'familiar_name' => __('translate.species_horse')]);
        }

        return redirect()->route('home')->with('success', __('message.clinic_store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        $watchdog = new Watchdog();

        // SELECT * FROM `watchdogs` where clinic_id=1 and user_id=1 GROUP by request_uri
        $lastVisitByUser = $watchdog->all()
            ->sortByDesc('created_at')
            ->where('clinic_id', '=', $clinic->id)
            ->where('user_id', '=', auth()->user()->id)
            ->where('type', '=', 'visit')
            ->where('severity', '=', 0)
            ->groupBy('request_uri')
            ->take(5);

        $lastVisitByClinic = $watchdog->all()
            ->sortByDesc('created_at')
            ->where('clinic_id', '=', $clinic->id)
            ->where('type', '=', 'visit')
            ->where('severity', '=', 0)
            ->groupBy('request_uri')
            ->take(5);

        // dd($lastVisitByUser);
        return view('clinics.show')->with('clinic', $clinic)->with(compact('lastVisitByUser', 'lastVisitByClinic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
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
        $clinic->manager = $request->manager;
        $clinic->code = $request->code;
        $clinic->address = $request->address;
        $clinic->postcode = $request->postcode;
        $clinic->city = $request->city;
        $clinic->phone = $request->phone;
        $clinic->website = $request->website;
        $clinic->email = $request->email;

        $imageName = null;
        if ($request->file('logo'))
        {
            $imagePath = $request->file('logo');
            $imageName =  'veterinary-clinic-logo-' . $clinic->id . '-' . Str::random(8) . '.' . $imagePath->getClientOriginalExtension();

            $request->logo->move(public_path('images'), $imageName);

            // delete previous file if exists
            if ($clinic->logo != null && file_exists(public_path('images') . '/' . $clinic->logo))
            {
                unlink(public_path('images') . '/' . $clinic->logo);
            }
            $clinic->logo = $imageName;
        }

        if ($clinic->save())
        {
            $request->session()->flash('success', __('message.clinic_update_success'));
        }
        else
        {
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
        $clinic->delete();
        return redirect()->route('home')->with('success', __('message.clinic_destroy_success'));
    }


    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {
        // @YAH
        // dd( Carbon::today()->format('Ymd') );
        return view('clinics.join');
    }


    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enroll(Request $request)
    {
        // split the token and compose serial / key attributes
        $aToken = explode('-', $request->token);

        if ($aToken == false || count($aToken) != 2)
        {
            $request->session()->flash('error', __('message.clinic_join_error'));
            return redirect()->route('home');
        }

        $serial = $aToken[0];
        $handshakeRequest = $aToken[1];

        // load a clinic object
        $clinic = Clinic::where('serial', $serial)->first();

        if ($clinic == null)
        {
            $request->session()->flash('error', __('message.clinic_join_not_found'));
        }
        else
        {
            if ($clinic->users->where('id', Auth::user()->id)->count() > 0)
            {
                $request->session()->flash('error', __('message.clinic_join_user_exists'));
            }
            else
            {
                // user does not exists. check the handshake
                $handshakeResponse = substr(md5(Auth::user()->email . $clinic->key . Carbon::today()->format('Ymd')), 0, 8);
                if ($handshakeRequest === $handshakeResponse)
                {
                    $veterinarianRole = Role::where('name', 'veterinarian')->first();
                    $clinic->roles()->attach($veterinarianRole, ['user_id' => Auth::user()->id]);

                    $request->session()->flash('success', __('message.clinic_join_success'));
                }
                else
                {
                    $request->session()->flash('error', __('message.clinic_join_error'));
                }
            }
        }
        return redirect()->route('home');
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
            // Note: invite everyone or email must exists in user table
            // 'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $token = $clinic->serial . '-' . substr(md5($request->email . $clinic->key . Carbon::today()->format('Ymd')), 0, 8);
        Mail::to($request->email)->send(new ClinicJoinMail($clinic, $token));

        return redirect()->route('clinics.show', $clinic)->with('success', __('message.clinic_invitation_success'));
    }
}
