<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\UsersApiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
   if(Auth::check()){
       return redirect()->route('dashboard');
   }else{
       return redirect()->route('login');
   }
});

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/api/login',[AuthApiController::class,'login']);

Route::get('/dashboard',[PagesController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('/users',[UsersController::class,'index'])->name('users')->middleware('auth');
Route::get('/users/new',[UsersController::class,'new'])->name('users/new')->middleware('auth');
Route::get('/users/edit/{param}',[UsersController::class,'edit'])->name('users/edit')->middleware('auth');
Route::get('/blog',[BlogController::class,'index'])->name('blog')->middleware('auth');
Route::get('/blog/new',[BlogController::class,'new'])->name('blog/new')->middleware('auth');
Route::get('/blog/edit/{id}',[BlogController::class,'edit'])->name('blog/edit')->middleware('auth');

Route::post('/api/users/getData',[UsersApiController::class,'getData'])->middleware('auth');
Route::post('/api/users/saveUser',[UsersApiController::class,'saveUser'])->middleware('auth');
Route::post('/api/users/delUser',[UsersApiController::class,'delUser'])->middleware('auth');

Route::post('/api/blogs/getData',[BlogApiController::class,'getData'])->middleware('auth');
Route::post('/api/blogs/passive',[BlogApiController::class,'passive'])->middleware('auth');
Route::post('/api/blogs/active',[BlogApiController::class,'active'])->middleware('auth');
Route::post('/api/blogs/delete',[BlogApiController::class,'delete'])->middleware('auth');
Route::post('/api/blogs/save',[BlogApiController::class,'save'])->middleware('auth');
Route::post('/api/blogs/getBlogData',[BlogApiController::class,'getBlogData'])->middleware('auth');

