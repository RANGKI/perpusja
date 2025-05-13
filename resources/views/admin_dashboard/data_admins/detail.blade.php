@extends('layouts.sidebar')

@section('title', 'Detail Admin')

@section('content')

{{-- Success message --}}
@include('components.success')

<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">
    
    <!-- Profile Image Upload Preview -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <label for="image_path" class="cursor-pointer">
        <div class="w-40 h-40 border rounded-lg flex items-center justify-center overflow-hidden bg-gray-100">
          <img id="preview-image" src="{{ asset('storage/' . $admin->image_path) }}" alt="Profile" class="object-cover w-full h-full">
        </div>
      </label>
    </div>
    
    <!-- Admin Information Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Keterangan Admin</h2>
        <a href="{{ url('/admin/data_admin') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>
      
      <form method="POST" action="{{ url('/admin/data_admin/' . $admin->id . '/update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <input id="image_path" type="file" name="image_path" accept="image/*" class="hidden" onchange="previewImage(event)">
        <div class="mb-4">
          <label class="block font-semibold mb-1">Username</label>
          <input type="text" name="username" value="{{ $admin->username }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Email</label>
          <input type="email" name="email" value="{{ $admin->email }}" class="w-full px-4 py-2 border rounded focus:outline-none">
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Password</label>
          <input type="password" name="password" value="{{ $admin->password }}" class="w-full px-4 py-2 border rounded focus:outline-none">
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
    const image = event.target.files[0];
    const preview = document.getElementById('preview-image');
    if (image) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(image);
    }
  }
</script>
@endsection
