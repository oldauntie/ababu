<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Role;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function passwordEdit()
    {
        return view('users.password');
    }


    /**
     * change User Password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function passwordChange(Request $request)
    {
        $request->validate([
            'password_current' => ['required', new MatchOldPassword],
            'password_new' => ['required'],
            'password_new_confirm' => ['same:new_password'],
        ]);

        try
        {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->password_new)]);
            $request->session()->flash('success', __('message.password_update_success'));
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            $request->session()->flash('success', __('message.password_update_error'));
        }

        return redirect()->route('home');
    }

    /**
     * Show the user profile form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profileEdit()
    {
        return view('users.profile');
    }


    /**
     * update User Profile data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'registration' => ['max:255'],
            'phone' => ['max:64'],
            'mobile' => ['max:64'],
        ]);

        try
        {
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->registration = $request->registration;
            $user->phone = $request->phone;
            $user->mobile = $request->mobile;

            $user->update();
            $request->session()->flash('success', __('message.profile_update_success'));
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            $request->session()->flash('success', __('message.profile_update_error'));
        }

        return redirect()->route('home');
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
