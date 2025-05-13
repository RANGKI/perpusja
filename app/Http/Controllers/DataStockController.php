<?php

namespace App\Http\Controllers;

use App\Models\DataStock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function update_data(Request $request, $id) {
        
        $validated = $request->validate([
            'nama_buku' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kode_buku' => 'required|string|max:20',
        ]);

        $book = DataStock::findOrFail($id);

        $book->update([
            'nama_buku' => $validated['nama_buku'],
            'jumlah' => $validated['jumlah'],
            'kode_buku' => $validated['kode_buku'],
        ]);

        return redirect('/admin/data_stock/' . $id . '/detail')->with('success', 'Data updated!');
    }

    public function delete_data($id) {
        $book = DataStock::findOrFail($id);
        if ($book) {
            $book->delete();
            return redirect('/admin/data_stock/')->with('success', 'Data deleted!');
        }
    }

    public function show_create() {
        return view('admin_dashboard.data_stocks.create');
    }
    
    public function create_data(Request $request) {
    $validated = $request->validate([
        'nama_buku' => 'required|string|max:255|unique:data_stock,nama_buku',
        'jumlah' => 'required|integer',
        'kode_buku' => 'required|string|min:6',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle image upload with unique filename
    if ($request->hasFile('image_path')) {
        $file = $request->file('image_path');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension(); // generate unique name
        $path = $file->storeAs('image/book_cover', $filename, 'public');
    } else {
        $path = 'default.jpg';
    }

    // Create the book entry
    DataStock::create([
        'image_path' => $path,
        'nama_buku' => $validated['nama_buku'],
        'jumlah' => $validated['jumlah'],
        'kode_buku' => $validated['kode_buku'],
    ]);

    return redirect('/admin/data_stock')->with('success', 'Book added successfully!');
}
}
