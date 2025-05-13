<?php

namespace App\Http\Controllers;

use App\Models\DataAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        if ($validated['password'] == $user->password) {
            $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'], 
        ]);
        } else {
            $user->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']), 
            ]);
        }
        session(['username' => $validated['username']]);
        return redirect('/admin/data_admin/' . $id . '/detail')->with('success', 'Data updated!');
    }

    public function show_create() {
        return view('admin_dashboard.data_admins.create');
    }


public function create_data(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:data_admin,username',
        'email' => 'required|email|max:255|unique:data_admin,email',
        'password' => 'required|string|min:6',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $imageName = 'default.jpg';
    if ($request->hasFile('image_path')) {
        $image = $request->file('image_path');
        $randomName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/image/admins', $randomName);
        $imageName = '/image/admins/' . $randomName;
    }

    DataAdmin::create([
        'image_path' => $imageName,
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    return redirect('/admin/data_admin')->with('success', 'Admin created successfully!');
}


    public function delete_data($id) {
        $admin = DataAdmin::findOrFail($id);
        if ($admin) {
            $admin->delete();
            return redirect('/admin/data_admin')->with('success', 'Data deleted!');
        }
    }
}
