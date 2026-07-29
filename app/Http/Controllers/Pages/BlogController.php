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
    public function like($id)
{
    $blog = Blogs::findOrFail($id);
    $blog->increment('likes_count');

    return response()->json([
        'status' => 'success',
        'likes' => $blog->likes_count
    ]);
}

public function dislike($id)
{
    $blog = Blogs::findOrFail($id);
    $blog->increment('dislikes_count');

    return response()->json([
        'status' => 'success',
        'dislikes' => $blog->dislikes_count
    ]);
}

}
