@extends('layouts.sidebar')

@section('title', 'Keterangan Pengguna')

@section('content')
{{-- Success message --}}
@include('components.success')
<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">
    
    <!-- Profile Image Upload Preview -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <label for="image" class="cursor-pointer">
        <div class="w-40 h-40 border rounded-lg flex items-center justify-center overflow-hidden bg-gray-100">
          <img id="preview-image" src="{{ asset('storage/' . $user->image_path) }}" alt="User profile" class="object-cover w-full h-full {{ $user->image_path ? '' : 'hidden' }}">
          <span id="no-image-text" class="text-gray-400 {{ $user->image_path ? 'hidden' : '' }}">Klik untuk upload</span>
        </div>
      </label>
    </div>
    
    <!-- User Information Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Keterangan Pengguna</h2>
        <a href="{{ url('/admin/data_personal/') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>
      
      <form method="POST" action="{{ url('/admin/data_personal/' . $user->id . '/update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <input id="image" type="file" name="image_profile" accept="image/*" class="hidden" onchange="previewImage(event)">
        <div class="mb-4">
          <label class="block font-semibold mb-1">Nama Pengguna</label>
          <input type="text" name="username" value="{{ $user->username }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Email</label>
          <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">No. Telepon</label>
          <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Password</label>
          <input type="password" name="password" value="{{ $user->password }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
          Simpan Perubahan
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
