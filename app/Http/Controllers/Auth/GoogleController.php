<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            
            $finduser = User::where('google_id', $user->id)->first();
            
            if($finduser){
                
                Auth::login($finduser);
                
                return redirect('/');
                
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'google_id'=> $user->id,
                    'slug' => \Str::slug($user->name."-".\Str::random(5)),
                    'foto' => $user->avatar,
                    'email' => $user->email,
                    'email_verified_at' => now(),
                    'password' => encrypt(md5($user->token))
                ]);
                
                Auth::login($newUser);

                Profile::create([
                    "user_id" => $newUser->id
                ]);
                
                return redirect('/');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}