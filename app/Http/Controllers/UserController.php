<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    
    public function show($id)
    {
        $user = User::find($id);

        return view('users.index')->with('user', $user);
    }

}
