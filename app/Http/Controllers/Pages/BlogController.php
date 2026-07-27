<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Support\Facades\View;

class BlogController
{

    public function index()
    {
        return view('pages.blog.index');
    }

    public function new()
    {
        View::share('blog',null);
        return view('pages.blog.detail');
    }

    public function edit($id)
    {
        View::share('blog',$id);
        return view('pages.blog.detail');
    }

}
