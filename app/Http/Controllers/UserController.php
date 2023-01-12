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
}
