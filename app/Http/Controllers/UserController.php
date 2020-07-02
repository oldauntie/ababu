<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function list($clinic_id = 0)
    {
        $clinic = Clinic::findOrFail($clinic_id);
        return view('users.list')->with('clinic', $clinic);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($clinic_id, $user_id)
    {
        $clinic = Clinic::findOrFail($clinic_id);
        $roles = Role::where('name', '!=', 'root')->get();
        $user = User::findOrFail($user_id);
        return view('users.edit')->with( compact('clinic', 'roles', 'user') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clinic_id, $user_id)
    {
        $clinic = Clinic::where('id', '=', $clinic_id)->first();
        $user = User::where('id', '=', $user_id)->first();
        
        $currentRoleId = $clinic->roles()->wherePivot('user_id', $user_id)->first();

        foreach ($request->roles as $role_id) {
            $clinic->roles()->wherePivot('user_id', $user_id)->updateExistingPivot($currentRoleId, ['role_id' => $role_id]);
        }

        $request->session()->flash('success', __('message.user_update_success'));


        return redirect()->route('clinics.users.list', $clinic_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajax($clinic_id = 0)
    {
        // d($clinic_id);
        return Datatables::of(User::all())
            ->addColumn('action', function ($data) {
                return '<a href="' . route('users.edit', $data->id) . '"><button type="button" class="btn btn-sm btn-primary float-left">'. __('translate.edit') .'</button></a>'
                .'<a href="' . route('users.edit', $data->id) . '"><button type="button" class="btn btn-sm btn-warning float-left">'. __('translate.disable') .'</button></a>'
                .'<a href="' . route('users.edit', $data->id) . '"><button type="button" class="btn btn-sm btn-danger float-left">'. __('translate.delete') .'</button></a>';
            })
            ->make(true);
    }
}
