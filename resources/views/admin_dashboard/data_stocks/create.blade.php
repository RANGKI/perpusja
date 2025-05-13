@extends('layouts.sidebar')

@section('title', 'Tambah Buku')

@section('content')
<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">
    
    <!-- Book Cover Placeholder -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <div class="w-40 h-56 border rounded-lg flex items-center justify-center">
        <span class="text-gray-400">No Cover</span>
      </div>
    </div>

    <!-- Book Creation Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Tambah Buku Baru</h2>
        <a href="{{ url('/admin/data_stock') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>

      <form method="POST" action="{{ url('/admin/data_stock/create') }}">
        @csrf

        <div class="mb-4">
          <label class="block font-semibold mb-1">Nama buku :</label>
          <input type="text" name="nama_buku" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Jumlah :</label>
          <input type="number" name="jumlah" value="{{ old('stock') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Kode Buku : </label>
          <input type="text" name="kode_buku" value="{{ old('category') }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
          Tambah Buku
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
