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
}
