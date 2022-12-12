<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\HomeController;
use App\Http\controllers\AdminController;
use App\Http\controllers\CategoryController;
use App\Http\controllers\PostController;
use App\Http\controllers\SettingController;
use App\Http\controllers\SocialController;
use Laravel\Socialite\Facades\Socialite;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





Route :: get('/',[HomeController::class,'index']);
Route :: get('/detail/{id}',[HomeController::class,'detail']);
Route :: get('/category/{id}',[HomeController::class,'category']);
Route :: get('/all-categories',[HomeController::class,'all_category']);
// Route :: post('/save-comment/{slug}/{id}',[HomeController::class,'save_comment']);
Route :: post('/save-comment/{id}',[HomeController::class,'save_comment']);
Route :: get('save_post_form',[HomeController::class,'save_post_form']);
Route :: post('save_post_form',[HomeController::class,'save_post_data']);
Route :: get('manage-posts',[HomeController::class,'manage_posts']);
     // admin routes
Route :: get('/admin/login',[AdminController::class,'login']);

Route :: post('/admin/login',[AdminController::class,'submit_login']);

Route :: get('/admin/logout',[AdminController::class,'logout']);

Route :: get('/admin/dashboard',[AdminController::class,'dashboard']);

Route :: get('/admin/comment',[AdminController::class,'comments']);

Route :: get('/admin/comment/delete/{id}',[AdminController::class,'delete_comment']);

Route :: get('/admin/users',[AdminController::class,'users']);

Route :: get('/admin/users/delete/{id}',[AdminController::class,'delete_users']);


               // category routes
Route::get('admin/category/{id}/delete',[CategoryController :: class,'destroy']);

Route::resource('admin/category', CategoryController::class);

// Route::resource('admin/category/create', CategoryController::class);

                          // post routes
Route::get('admin/post/{id}/delete',[PostController :: class,'destroy']);

Route::resource('admin/post', PostController::class);

  // setting
Route:: get('/admin/setting',[SettingController::class,'index']);

 Route:: post('/admin/setting',[SettingController::class,'store']);

Auth::routes();


Route::get('/auth/google/redirect',[SocialController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialController::class, 'callback']);
// Route::get('/home', [SocialController::class, 'home']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
