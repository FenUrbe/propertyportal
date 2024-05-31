<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $google_user = Socialite::driver('google')->stateless()->user();

        $user = User::where('provider_id', $google_user->getId())->first();

        if (!$user) {
            $user = User::where('email', $google_user->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'provider_id' => $google_user->getId(),
                    'is_verified' => 1
                ]);
            } else {
                $user->provider_id = $google_user->getId();
                $user->save();
            }
        }

        Auth::login($user);

        return redirect()->intended('user');
    }

}
