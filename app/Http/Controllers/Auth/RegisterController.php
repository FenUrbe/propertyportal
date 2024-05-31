<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;

class RegisterController extends Controller
{

    public function registerUser(){
        return view('auth.register');
    }

    public function saveInfo(Request $request){
        $messages = [
            'email.unique' => 'The email address has already been taken.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least :min characters.',
        ];

        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'user_type' => 'required'
        ], $messages);

        $newUser = User::create($data);

        $verificationUrl = URL::signedRoute('email.verify', [
            'id' => $newUser->id,
            'hash' => sha1($newUser->email),
        ]);

        Mail::to($newUser->email)->send(new VerifyEmail($verificationUrl));

        return redirect(route('user.index'));
    }

    public function verifyEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (! URL::hasValidSignature($request)) {
            abort(403, 'Invalid verification link');
        }
    
        $user->is_verified = 1;
        $user->save();

        return view('notif.verified');
    }
}
