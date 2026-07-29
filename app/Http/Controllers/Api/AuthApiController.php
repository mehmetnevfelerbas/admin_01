<?php

namespace App\Http\Controllers\Api;

use App\Classes\LoginClass;
use App\Classes\RegisterClass;

class AuthApiController
{
   
    public function login(){
        $class = new LoginClass();
        return response()->json($class->login());
    }
    public function register(){
        $class = new RegisterClass();
        return response()->json($class->register());
    }
}
