<?php

namespace App\Http\Controllers\Api;

use App\Classes\LoginClass;
use App\Classes\UsersClass;

class UsersApiController
{
   
    public function getData(){
        $class = new UsersClass();
        return $class->getData();
    }

    public function saveUser(){
        $class = new UsersClass();
        return response()->json($class->saveUser());
    }

    public function delUser(){
        $class = new UsersClass();
        return response()->json($class->delUser());
    }
}
