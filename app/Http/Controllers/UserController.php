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

    public function list(Clinic $clinic)
    {
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
    public function edit(Clinic $clinic, User $user)
    {
        $roles = Role::where('name', '!=', 'root')->get();
        return view('users.edit')->with( compact('clinic', 'roles', 'user') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, User $user)
    {
        $currentRoleId = $clinic->roles()->wherePivot('user_id', $user->id)->first();
        foreach ($request->roles as $role_id) {
            $clinic->roles()->wherePivot('user_id', $user->id)->updateExistingPivot($currentRoleId, ['role_id' => $role_id]);
        }
        $request->session()->flash('success', __('message.user_update_success'));

        return redirect()->route('clinics.users.list', $clinic);
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

    // @todo: to be finished or @deprecated
    public function ajaxUserList($clinic_id = 0)
    {
        return Datatables::of(User::all())
            ->addColumn('action', function ($data) {
                return '<a href="#"><button type="button" class="btn btn-sm btn-primary float-left">'. __('translate.edit') .'</button></a>'
                .'<a href="#"><button type="button" class="btn btn-sm btn-warning float-left">'. __('translate.disable') .'</button></a>'
                .'<a href="#"><button type="button" class="btn btn-sm btn-danger float-left">'. __('translate.delete') .'</button></a>';
            })
            ->make(true);
    }
}
