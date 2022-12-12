<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    // login view
    function login(){
        return view('backend.login');
    }
    // submit login
    function submit_login(Request $request){
       $request->validate([
           'username'=>'required',
           'password'=>'required'
       ]);

       $userCheck = Admin::where(['username'=>$request->username, 'password'=>$request->password])->count();
       if($userCheck>0){
    $adminData = Admin::where(['username'=>$request->username, 'password'=>$request->password])->first();
    session(['adminData'=>$adminData]);
           return redirect('admin/dashboard');
       }else{
           return redirect('admin/login')->with('error', 'Invalid username/password!!');
       }
    }
    //dashboard
    function dashboard(){
        return view ('backend.dashboard');
    }

    // show all comments
    function comments(){
      $data = Comment::orderBy('id', 'desc')->get();
      return view('backend.comment.index',['data'=>$data]);
    }

    function delete_comment($id){
     
      Comment::where('id',$id)->delete();
            return redirect('admin/comment');
    }

    // show all users
    function users(){
      $data = User::orderBy('id', 'desc')->get();
      return view('backend.users.index',['data'=>$data]);
    }

    function delete_users($id){
     
      User::where('id',$id)->delete();
            return redirect('admin/users');
    }

    function logout(){
        
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
