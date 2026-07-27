<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class LoginClass
{
   
    public function login(){
        
        try {

            $email = request()->get('email');
            $password = request()->get('password');

            if($email == null){
                return ["status"=>false,"message"=>"Email alanı boş olamaz."];
            }

            if($password == null){
                return ["status"=>false,"message"=>"Şifre alanı boş olamaz."];
            }

            $user = User::where('email',$email)->first();
            if($user == null){
                return ["status"=>false,"message"=>"Kullanıcı bulunamadı."];
            }

            if(!Hash::check($password,$user->password)){
                return ["status"=>false,"message"=>"Şifre hatalı."];
            }

            FacadesAuth::login($user);

            if(FacadesAuth::check()){
                return ["status"=>true,"message"=>"Giriş işlemi başarılı."];    
            }
         

        } catch (\Throwable $th) {
            return ["status"=>false,"message"=>"Giriş işlemi başarısız."];
        }
    }
}
