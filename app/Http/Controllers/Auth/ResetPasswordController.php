<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\ResetEmail;

class ResetPasswordController extends Controller
{
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User with this email not found');
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($token), 'created_at' => Carbon::now()]
        );

        Mail::to($user->email)->send(new ResetEmail($token, $user->email));

        return view('notif.password')->with('status', 'Password reset link sent to your email');
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        $passwordReset = DB::table('password_resets')->where('email', $email)->first();

        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) {
            return view('notif.invalid');
        }

        return view('auth.reset')->with(['token' => $token, 'email' => $email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $token = $request->token;
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User with this email not found');
        }

        $passwordReset = DB::table('password_resets')->where('email', $email)->first();

        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) {
            return redirect()->back()->with('error', 'Invalid or expired token');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);

        DB::table('password_resets')->where('email', $email)->delete();

        return view('notif.password')->with('status', 'Your password has been reset successfully.');
    }

}
