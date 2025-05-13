<?php
namespace App\Http\Controllers;

use App\Models\DataPinjaman;
use Illuminate\Http\Request;

class DataPinjamanController extends Controller {
    public function show()
    {
        $pinjaman = DataPinjaman::with(['user', 'book'])->paginate(10);
        return view('admin_dashboard.data_pinjaman.data_pinjaman', compact('pinjaman'));
    }
}