@extends('layouts.sidebar')

@section('title', 'Stock Data - Admin')

@section('content')
  <h1 class="text-5xl font-bold mb-6 text-center">Data Stock</h1>
@include('components.error')
  {{-- Success message --}}
  @include('components.success')
  <div class="flex justify-end mb-4">
    <a href="{{route('stock.export')}}"
       class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow">
        📥 Download Excel
    </a>
</div>
  <div class="overflow-x-auto">
    <form action="{{ route('stock.show') }}" method="GET" class="mb-4 flex justify-end">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search book..."
           class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
    <button type="submit"
            class="ml-2 px-4 py-2 bg-[#3D3BA0] text-white rounded-lg hover:bg-indigo-800">
        🔍 Search
    </button>
</form>
    <table class="min-w-full bg-white rounded shadow text-left">
      <thead class="bg-[#3D3BA0] text-white">
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

  <!-- Pagination Links -->
  <div class="mt-6 flex justify-center">
    {{ $books->links() }}
  </div>

  <div class="mt-10 flex justify-center">
    <a href="{{ url('/admin/data_stock/create') }}" class="flex items-center gap-2 px-6 py-3 bg-[#3D3BA0] hover:bg-indigo-900 text-white font-semibold rounded-2xl shadow-lg">
      <span class="text-2xl">+</span> Add Book
    </a>
  </div>
@endsection