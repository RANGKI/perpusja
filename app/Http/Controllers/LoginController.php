<?php

namespace App\Http\Controllers;

use App\Models\DataAdmin;
use App\Models\DataPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = DataAdmin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Session::put('user_type', 'admin');
            Session::put('user_id', $admin->id);
            Session::put('username', $admin->username);
            Session::put('image_path', $admin->image_path);
            $request->session()->regenerate();
            return redirect()->intended('/admin/data_admin');
        } else {
            $personal = DataPersonal::where('email', $credentials['email'])->first();
            if ($personal && Hash::check($credentials['password'], $personal->password)) {
                Session::put('user_type', 'personal');
                Session::put('user_id', $personal->id);
                Session::put('username', $personal->username);
                $request->session()->regenerate();
                return redirect()->intended('/personal/dashboard');
            }
        }


        return back()->with('error', 'The provided credentials do not match our records.')->onlyInput('email');
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush();

        return redirect('/login')->with('logout', 'Logout successfully');
    }
}
