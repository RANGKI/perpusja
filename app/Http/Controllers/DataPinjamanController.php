<?php
namespace App\Http\Controllers;

use App\Models\DataPinjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PinjamanExport;

class DataPinjamanController extends Controller {
    public function show(Request $request) {
    $query = DataPinjaman::with(['user', 'book']);

    if ($search = $request->input('search')) {
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('username', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");
        })->orWhereHas('book', function ($q) use ($search) {
            $q->where('nama_buku', 'like', "%$search%");
        });
    }

    $pinjaman = $query->paginate(10);
    return view('admin_dashboard.data_pinjaman.data_pinjaman', compact('pinjaman'));
}


    public function export() {
    return Excel::download(new PinjamanExport, 'data_pinjaman.xlsx');
}
}