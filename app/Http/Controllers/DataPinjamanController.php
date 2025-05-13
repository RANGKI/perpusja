<?php
namespace App\Http\Controllers;

use App\Models\DataPinjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PinjamanExport;

class DataPinjamanController extends Controller {
    public function show()
    {
        $pinjaman = DataPinjaman::with(['user', 'book'])->paginate(10);
        return view('admin_dashboard.data_pinjaman.data_pinjaman', compact('pinjaman'));
    }

    public function export() {
    return Excel::download(new PinjamanExport, 'data_pinjaman.xlsx');
}
}