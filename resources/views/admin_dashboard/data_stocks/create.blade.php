@extends('layouts.sidebar')

@section('title', 'Tambah Buku')

@section('content')
@include('components.error')
<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">

    <!-- Book Cover Upload -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <label for="cover" class="cursor-pointer">
        <div id="coverPreview" class="w-64 h-96 border rounded-lg flex items-center justify-center bg-gray-100 overflow-hidden">
          <span class="text-gray-400" id="coverText">No Cover</span>
          <img id="previewImage" src="#" alt="Preview" class="hidden w-full h-full object-cover" />
        </div>
      </label>
    </div>

    <!-- Book Creation Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Tambah Buku Baru</h2>
        <a href="{{ url('/admin/data_stock') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>

      <form method="POST" action="{{ url('/admin/data_stock/create') }}" enctype="multipart/form-data">
        @csrf

        <input type="file" name="image_path" id="cover" accept="image/*" class="hidden" onchange="previewCover(event)">

        <div class="mb-4">
          <label class="block font-semibold mb-1">Nama Buku :</label>
          <input type="text" name="nama_buku" value="{{ old('nama_buku') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Jumlah :</label>
          <input type="number" name="jumlah" value="{{ old('jumlah') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Kode Buku :</label>
          <input type="text" name="kode_buku" value="{{ old('kode_buku') }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
          Tambah Buku
        </button>
      </form>
    </div>
  </div>
</div>

{{-- JavaScript for live image preview --}}
<script>
  function previewCover(event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('previewImage');
    const coverText = document.getElementById('coverText');

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewImage.classList.remove('hidden');
        coverText.classList.add('hidden');
      };
      reader.readAsDataURL(file);
    }
  }
</script>
@endsection
