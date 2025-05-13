@extends('layouts.sidebar')

@section('title', 'Stock Data - Admin')

@section('content')
  <h1 class="text-5xl font-bold mb-6 text-center">Data Stock</h1>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow text-left">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-6 py-3">Nama Buku</th>
          <th class="px-6 py-3">Jumlah</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
          <tr class="border-b hover:bg-gray-100">
            <td class="px-6 py-4">{{ $book->nama_buku }}</td>
            <td class="px-6 py-4">{{ $book->jumlah }}</td>
            <td class="px-6 py-4">
              @if ($book->jumlah <= 0)
                <span class="text-red-600 font-semibold">Out of Stock</span>
              @else
                <span class="text-green-600 font-semibold">Available</span>
              @endif
            </td>
            <td class="px-6 py-4">
              <div class="flex space-x-4 items-center">
                <a href="{{ url('/admin/data_stock/' . $book->id . '/detail') }}" class="text-gray-800 hover:text-indigo-600">
                  ✎
                </a>
                <form onsubmit="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-delete-confirm', { detail: { action: this } }))" method="POST" action="{{ url('/admin/data_stock/' . $book->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:underline">Remove</button>
                  </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
