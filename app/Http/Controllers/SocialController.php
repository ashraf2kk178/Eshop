<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Socialite;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
// use Validator,Redirect,Response,File;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class SocialController extends Controller
{
    public function redirect(Request $request){
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request){
        // $user = Socialite::driver('google')->stateless()->user();
        //  dd($user);


        // try{
        //     $user = $Socialite::driver('google')->stateless()->user();

        //     $existinguser = User::where('google_id', $google_user->getId())->first();
        //     if($existinguser) {
        //         Auth::login($existinguser);
        //         return redirect('home');
                
        //     }
        //     else{
        //        $createuser = User::create([
        //             'name' => $user->name,
        //             'email' => $user->email,
        //             'google_id'=>$user->id,
        //         ]);
        //      Auth::login($createuser);
        //         return redirect('home');   
        //     }
        // }catch(\Throwable $th){
        //     throw $th;
        //    // dd('Something Went Wrong!' . $th->getMessage());
        // }

         $userdata = Socialite::driver('google')->stateless()->user();
         // dd($userdata);
         $user = User::where('email', $userdata->email)->where('auth_type', 'google')->first();
         if($user){
            //do login
         Auth::login($user);
         return redirect('/home');  
         }else{
            //register
           $uuid = Str::uuid()->toString();
         $user = new User();
         $user->name = $userdata->name;
         $user->email = $userdata->email;
         $user->password = Hash::make($uuid.now());
         $user->auth_type = 'google';
         $user->usertype = 'google';
         $user->save();
         Auth::login($user);
         return redirect('/home');  
         }
        
    }
   
   }
