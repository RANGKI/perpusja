@extends('layouts.sidebar')

@section('title', 'Status Buku')

@section('content')
<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">

    <!-- Book Cover Image -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <div class="w-48 h-72 border rounded-lg overflow-hidden">
        <img src="{{ asset('storage/' . $book->image_path) }}" alt="Book Cover" class="w-full h-full object-cover">
      </div>
    </div>

    <!-- Book Information Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Status Buku</h2>
        <a href="{{ url('/admin/data_stock') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>

      <form method="POST" action="{{ url('/admin/data_stock/' . $book->id . '/update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <label class="block font-semibold mb-1">Nama Buku</label>
          <input type="text" name="nama_buku" value="{{ $book->nama_buku }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Jumlah</label>
          <input type="number" name="jumlah" value="{{ $book->jumlah }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Status</label>
          <input type="text" value="{{ $book->jumlah <= 5 ? 'Out of Stock' : 'Available' }}" readonly
            class="w-full px-4 py-2 border rounded {{ $book->jumlah <= 5 ? 'text-red-500' : 'text-green-600' }}">
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Kode Buku</label>
          <input type="text" name="kode_buku" value="{{ $book->kode_buku }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
          Simpan Perubahan
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
