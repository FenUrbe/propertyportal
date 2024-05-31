<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        $facebook_user = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('provider_id', $facebook_user->getId())->first();

        if (!$user) {
            $user = User::where('email', $facebook_user->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'provider_id' => $facebook_user->getId(),
                    'is_verified' => 1
                ]);
                dd($user);
            } else {
                $user->provider_id = $facebook_user->getId();
                $user->save();
                dd($user);
            }
        }

        Auth::login($user);

        return redirect()->intended('user');
    }

}
