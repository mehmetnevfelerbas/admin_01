<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;

class UsersController
{

    public function index()
    {
        return view('pages.users.index');
    }

    public function new()
    {

        view()->share('user', null);

        return view('pages.users.detail');
    }

    public function edit($param)
    {

        $user = User::where('id', $param)->first();
        if($user == null){
            return redirect()->route('users');
        }

        view()->share('user', $user);

        return view('pages.users.detail');
    }
}
