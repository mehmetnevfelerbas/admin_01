<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;
use Illuminate\Http\Request; 

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

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
     
        $user->status = ($user->status == 1) ? 0 : 1;
        $user->save();

        return back()->with('success', 'Kullanıcı onay durumu güncellendi.');
    }
   
    public function updateProfile(Request $request)
    {
        // Giriş yapan aktif kullanıcıyı doğrudan alıyoruz
        $user = auth()->user();

        // Formdan gelen verileri doğrulama ve güncelleme
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Eğer şifre alanı dolu gönderildiyse şifreyi güncelle
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return back()->with('success', 'Bilgileriniz başarıyla güncellendi.');
    }
}