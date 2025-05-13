<?php

namespace App\Http\Controllers;

use App\Models\DataAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataAdminController extends Controller
{
    public function show() {
        $admins = DataAdmin::paginate(10);
        return view('admin_dashboard.data_admins.data_admin',['admins' => $admins]);
    }

    public function show_detail($id) {
        $admin = DataAdmin::findOrFail($id);
        return view('admin_dashboard.data_admins.detail',['admin' => $admin]);
    }

    public function update_data(Request $request, $id)
{
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:6',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = DataAdmin::findOrFail($id);

    // Update profile image if uploaded
    if ($request->hasFile('image_path')) {
        $image = $request->file('image_path');
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();

        // Delete old image if not default
        if ($user->image_path !== 'default.jpg') {
            Storage::delete('public/' . $user->image_path);
        }

        $image->storeAs('public/image/admins', $imageName);
        $user->image_path = 'image/admins/' . $imageName;

        // Update session image path
        session(['image_path' => $user->image_path]);
    }

    // Update password only if changed
    if ($validated['password'] == $user->password) {
        $user->password = $user->password;
    } else {
        $user->password = bcrypt($validated['password']);
    }

    // Update other fields
    $user->username = $validated['username'];
    $user->email = $validated['email'];
    $user->save();

    // Update session username
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
