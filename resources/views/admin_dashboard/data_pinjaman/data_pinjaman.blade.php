@extends('layouts.sidebar')

@section('title', 'Data Pinjaman')

@section('content')
  <h1 class="text-5xl font-bold mb-6 text-center">Data Pinjaman</h1>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow text-left">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-6 py-3">Profile</th>
          <th class="px-6 py-3">Username</th>
          <th class="px-6 py-3">Email</th>
          <th class="px-6 py-3">Nama Buku</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pinjaman as $data)
          <tr class="border-b hover:bg-gray-100">
            <td class="px-6 py-4">
              <img src="{{ asset('storage/' . $data->user->image_path) }}" alt="Profile Image" class="w-12 h-12 object-cover rounded-full">
            </td>
            <td class="px-6 py-4">{{ '@' . $data->user->username }}</td>
            <td class="px-6 py-4">{{ $data->user->email }}</td>
            <td class="px-6 py-4">{{ $data->book->nama_buku }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
