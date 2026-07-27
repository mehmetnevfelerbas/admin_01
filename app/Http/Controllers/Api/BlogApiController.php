<?php

namespace App\Http\Controllers\Api;

use App\Classes\BlogClass;
use App\Classes\LoginClass;
use App\Classes\UsersClass;

class BlogApiController
{

    public function getData(){
        $class = new BlogClass();
        return $class->getData();
    }

    public function passive(){
        $class = new BlogClass();
        return $class->passive();
    }

    public function active(){
        $class = new BlogClass();
        return $class->active();
    }

    public function delete(){
        $class = new BlogClass();
        return $class->delete();
    }

    public function save(){
        $class = new BlogClass();
        return $class->save();
    }

    public function getBlogData(){
        $class = new BlogClass();
        return $class->getBlogData();
    }


}
