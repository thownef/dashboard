<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        User::where('email', $request->email)->update([
            'remember_token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = User::where([
            'email' => $request->email,
            'remember_token' => $request->token,
        ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password), "remember_token" => null]);

        return redirect('/forget-password')->with('message', 'Your password has been changed!');
    }
    public function changePassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid Account'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Wrong password'], 401);
        }

        if ($request->password === $request->new_password) {
            return response()->json(['message' => 'New password must be different from old password'], 400);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'message' => 'Password changed successfully',
        ], 200);
    }
}
