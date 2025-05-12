@extends('layouts.sidebar')

@section('title', 'Create Admin')

@section('content')
<div class="container mx-auto px-6 py-10">
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between border p-6 rounded-lg shadow-md bg-white">
    
    <!-- Profile Image Placeholder -->
    <div class="mb-6 md:mb-0 md:mr-8 flex justify-center">
      <div class="w-40 h-40 border rounded-lg flex items-center justify-center">
        <span class="text-gray-400">No Image</span>
      </div>
    </div>

    <!-- Admin Creation Form -->
    <div class="w-full md:w-1/2">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Tambah Admin Baru</h2>
        <a href="{{ url('/admin/data_admin') }}" class="text-blue-500 hover:underline">Kembali</a>
      </div>

      <form method="POST" action="{{ url('/admin/data_admin') }}">
        @csrf

        <div class="mb-4">
          <label class="block font-semibold mb-1">Username</label>
          <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <div class="mb-6">
          <label class="block font-semibold mb-1">Password</label>
          <input type="password" name="password" value="{{ old('password') }}" class="w-full px-4 py-2 border rounded focus:outline-none" required>
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
          Tambah Admin
        </button>
      </form>
    </div>
  </div>
</div>
@endsection