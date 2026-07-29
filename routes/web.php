<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\UsersApiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\UsersController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PagesController::class, 'blogs'])->name('home');
Route::get('/haberler', [PagesController::class, 'blogs'])->name('visitor.blogs');

// Login Sayfası
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PagesController::class, 'index'])->name('dashboard');
    
  
});

Route::get('/', [PagesController::class, 'blogs'])->name('home');
Route::get('/haberler', [PagesController::class, 'blogs'])->name('visitor.blogs');



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/api/login', [AuthApiController::class, 'login']);


Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [PagesController::class, 'index'])->name('dashboard');
    
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/users/new', [UsersController::class, 'new'])->name('users/new');
    Route::get('/users/edit/{param}', [UsersController::class, 'edit'])->name('users/edit');
    
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/new', [BlogController::class, 'new'])->name('blog/new');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog/edit');

    Route::post('/api/users/getData', [UsersApiController::class, 'getData']);
    Route::post('/api/users/saveUser', [UsersApiController::class, 'saveUser']);
    Route::post('/api/users/delUser', [UsersApiController::class, 'delUser']);

    Route::post('/api/blogs/getData', [BlogApiController::class, 'getData']);
    Route::post('/api/blogs/passive', [BlogApiController::class, 'passive']);
    Route::post('/api/blogs/active', [BlogApiController::class, 'active']);
    Route::post('/api/blogs/delete', [BlogApiController::class, 'delete']);
    Route::post('/api/blogs/save', [BlogApiController::class, 'save']);
    Route::post('/api/blogs/getBlogData', [BlogApiController::class, 'getBlogData']);




Route::middleware('auth')->group(function () {
    Route::get('/profil', [PagesController::class, 'profile'])->name('profile.edit');

    Route::put('/profil/guncelle', [UsersController::class, 'updateProfile'])->name('profile.update');


Route::middleware('auth')->group(function () {
    Route::get('/ayarlar', [PagesController::class, 'settings'])->name('settings.index');


Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::post('/api/register', [AuthApiController::class, 'register'])->name('api.register');
Route::get('/haber/{id}', [App\Http\Controllers\Pages\PagesController::class, 'detail'])->name('news.detail');



Route::post('/haber/{id}/like', [PagesController::class, 'like'])->name('blog.like');
Route::post('/haber/{id}/dislike', [PagesController::class, 'dislike'])->name('blog.dislike');
    });
    });
});