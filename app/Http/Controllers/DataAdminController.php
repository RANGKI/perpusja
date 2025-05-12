<?php

namespace App\Http\Controllers;

use App\Models\DataAdmin;
use Illuminate\Http\Request;

class DataAdminController extends Controller
{
    public function show() {
        $admins = DataAdmin::all();
        return view('admin_dashboard.data_admins.data_admin',['admins' => $admins]);
    }

    public function show_detail($id) {
        $admin = DataAdmin::findOrFail($id);
        return view('admin_dashboard.data_admins.detail',['admin' => $admin]);
    }

    public function update_data(Request $request, $id) {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        
        $user = DataAdmin::findOrFail($id);
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), 
        ]);

        return redirect('/admin/data_admin/' . $id . '/detail')->with('success', 'Data updated!');
    }
}
