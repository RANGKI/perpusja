<?php

namespace App\Http\Controllers;

use App\Models\DataPersonal;
use Illuminate\Http\Request;

class DataPersonalController extends Controller
{
    public function show() {
        $users = DataPersonal::all();
        return view('admin_dashboard.data_personals.data_personals',['users' => $users]);
    }

    public function show_detail($id) {
        $user = DataPersonal::findOrFail($id);
        return view('admin_dashboard.data_personals.detail', ['user' => $user]);
    }

    public function update_data(Request $request, $id)
    {
        
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        
        $user = DataPersonal::findOrFail($id);
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => bcrypt($validated['password']), 
        ]);

        return redirect('/admin/data_personal/' . $id . '/detail')->with('success', 'Data updated!');
    }

    public function delete_data($id) {
        $user = DataPersonal::findOrFail($id);
        if ($user) {
            $user->delete();
            return redirect('/admin/data_personal/')->with('success', 'Data Deleted!');
        }
    }

}
