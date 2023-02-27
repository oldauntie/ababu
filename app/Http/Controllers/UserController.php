<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    

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
}
