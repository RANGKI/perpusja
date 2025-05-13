@extends('layouts.sidebar')

@section('title', 'Create Admin')

@section('content')
<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">

    <!-- Profile Image Upload Preview -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <label for="image" class="cursor-pointer">
        <div class="w-40 h-40 border rounded-lg flex items-center justify-center overflow-hidden bg-gray-100">
          <img id="preview-image" src="" alt="No Image" class="hidden object-cover w-full h-full">
          <span id="no-image-text" class="text-gray-400">Klik untuk upload</span>
        </div>
      </label>
    </div>
    
    <!-- Admin Creation Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Tambah Admin Baru</h2>
        <a href="{{ url('/admin/data_admin') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>
      
      <form method="POST" action="{{ url('/admin/data_admin/create') }}" enctype="multipart/form-data">
        @csrf
        
        <input id="image" type="file" name="image_path" accept="image/*" class="hidden" onchange="previewImage(event)">
        <div class="mb-4">
          <label class="block font-semibold mb-1">Username</label>
          <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Password (Min 6)</label>
          <input type="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
          Tambah Admin
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Image Preview Script -->
<script>
  function previewImage(event) {
    const image = document.getElementById('image').files[0];
    const preview = document.getElementById('preview-image');
    const noImageText = document.getElementById('no-image-text');

    if (image) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        noImageText.classList.add('hidden');
      };
      reader.readAsDataURL(image);
    }
  }
</script>
@endsection
