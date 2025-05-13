<?php

namespace App\Http\Controllers;

use App\Models\DataStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exports\StockExport;
use Maatwebsite\Excel\Facades\Excel;

class DataStockController extends Controller
{
    public function show() {
        $books = DataStock::paginate(10); // Paginate with 10 items per page
        return view('admin_dashboard.data_stocks.data_stock', compact('books'));
    }

    public function show_detail($id) {
        $book = DataStock::findOrFail($id);
        return view('admin_dashboard.data_stocks.detail',['book' => $book]);
    }

    public function update_data(Request $request, $id) {
    // Validate the inputs
    $validated = $request->validate([
        'nama_buku' => 'required|string|max:255',
        'jumlah' => 'required|integer',
        'kode_buku' => 'required|string|max:20',
        'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validate the image input
    ]);

    // Find the book record
    $book = DataStock::findOrFail($id);

    // Handle the image upload if present
    if ($request->hasFile('image_path')) {
        // Delete old image if it exists
        if ($book->image_path && Storage::exists('public/' . $book->image_path)) {
            Storage::delete('public/' . $book->image_path);
        }

        // Store the new image and get the path
        $imagePath = $request->file('image_path')->store('image/book_cover','public');
        
        // Update the image path in the database
        $book->image_path = $imagePath;
    }

    // Update other fields
    $book->update([
        'nama_buku' => $validated['nama_buku'],
        'jumlah' => $validated['jumlah'],
        'kode_buku' => $validated['kode_buku'],
    ]);

    // Redirect with success message
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
    public function export() {
        return Excel::download(new StockExport, 'data_stock.xlsx');
    }
}
