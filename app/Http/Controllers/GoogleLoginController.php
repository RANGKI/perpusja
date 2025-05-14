<?php

namespace App\Http\Controllers;

use App\Models\DataAdmin;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class GoogleLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        // Find matching admin
        $user = DataAdmin::where('email', $googleUser->email)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'User not found!');
        }

        // Manually store user session (custom logic)
        Session::put('user_type', 'admin');
        Session::put('user_id', $user->id);
        Session::put('username', $user->username);
        Session::put('image_path', $user->image_path);
        $request->session()->regenerate();

        return redirect('/admin/data_admin');
    }
}
