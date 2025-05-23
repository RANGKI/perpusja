@extends('layouts.sidebar')

@section('title', 'Data Pinjaman')

@section('content')
@include('components.error')
  <h1 class="text-5xl font-bold mb-6 text-center">Data Pinjaman</h1>

  <div class="flex justify-end mb-4">
    <a href="{{route('pinjaman.export')}}"
       class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow">
        📥 Download Excel
    </a>
</div>

  @if ($pinjaman->isEmpty())
      <p class="text-center text-gray-600 mt-4">No loan data available.</p>
  @else
      <div class="overflow-x-auto">
        <form action="{{ route('pinjaman.show') }}" method="GET" class="mb-4 flex justify-end">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search username, email, or book..."
           class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
    <button type="submit"
            class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        🔍 Search
    </button>
</form>

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
                          <td class="px-6 py-4">{{ $data->user->username }}</td>
                          <td class="px-6 py-4">{{ $data->user->email }}</td>
                          <td class="px-6 py-4">{{ $data->book->nama_buku }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div class="mt-6 flex justify-center">
          {{ $pinjaman->links() }}
      </div>
  @endif
@endsection