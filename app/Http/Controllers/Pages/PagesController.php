<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\User;
use Illuminate\Support\Str; 

class PagesController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $approvedUsersCount = User::where('status', 1)->count();
        $pendingUsersCount = User::where('status', 0)->count();

        $totalBlogs = Blogs::where('status', 1)->count();

        $blogsForChart = Blogs::with('translate')
            ->where('status', 1)
            ->latest()
            ->take(10)
            ->get();

        $blogTitles = $blogsForChart->map(function($blog) {
            return Str::limit($blog->translate->title ?? $blog->title ?? 'Haber #'.$blog->id, 20);
        });

        $likes = $blogsForChart->pluck('likes_count');
        $dislikes = $blogsForChart->pluck('dislikes_count');

        return view('pages.dashboard', compact(
            'totalUsers', 
            'approvedUsersCount', 
            'pendingUsersCount', 
            'totalBlogs',
            'blogTitles',
            'likes',
            'dislikes'
        ));
    }

    public function blogs()
    {
        // SADECE status = 1 (Aktif) OLANLARI ÇEKİYORUZ
        $blogs = Blogs::with('translate')
            ->where('status', 1) 
            ->latest()
            ->get();

        return view('pages.blogs', compact('blogs'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('pages.profile', compact('user'));
    }

    public function settings()
    {
        return view('pages.settings');
    }

    public function detail($id)
    {
        $blog = Blogs::with('translate')->findOrFail($id);

        return view('pages.news-detail', compact('blog'));
    }   

    // --- BEĞENİ VE BEĞENMEME METOTLARI (AJAX İLE ÇALIŞIR) ---
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