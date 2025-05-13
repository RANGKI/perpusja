<?php

namespace App\Http\Controllers;

use App\Models\DataPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'image_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $user = DataPersonal::findOrFail($id);
    
    // Handle image upload if provided
    if ($request->hasFile('image_profile')) {
        // Delete old image if it exists
        if ($user->image_profile && Storage::exists('public/' . $user->image_profile)) {
            Storage::delete('public/' . $user->image_profile);
        }

        $imagePath = $request->file('image_profile')->store('image/users', 'public');
        $user->image_path = $imagePath;
    }

    // Update all fields (always bcrypt password)
    $user->username = $validated['username'];
    $user->email = $validated['email'];
    $user->phone_number = $validated['phone_number'];
    if ($user->password == $validated['password']) {
        $user->password = $user->password;
    } else {
        $user->password = bcrypt($validated['password']);
    }

    $user->save();

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
