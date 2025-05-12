<?php

namespace App\Http\Controllers;

use App\Models\DataStock;
use Illuminate\Http\Request;

class DataStockController extends Controller
{
    public function show() {
        $books = DataStock::all();
        return view('admin_dashboard.data_stocks.data_stock',['books' => $books]);
    }

    public function show_detail($id) {
        $book = DataStock::findOrFail($id);
        return view('admin_dashboard.data_stocks.detail',['book' => $book]);
    }
}
