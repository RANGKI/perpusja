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
}
