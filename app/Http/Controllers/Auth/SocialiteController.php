<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class SocialiteController extends Controller
{
    


    public function github()
    {
        return Socialite::driver('github')->redirect();
    }


    public function githubRedirect()
    {
        // get the oauth request from github to authenticate user

        $user = Socialite::driver('github')->user();

        $user = User::firstOrCreate([
            'email' =>  $user->email
        ],
        [
            'name' =>  $user->name,
            'password' =>   Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return redirect('/dashboard');
    }
}

