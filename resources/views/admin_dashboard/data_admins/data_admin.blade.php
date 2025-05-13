@extends('layouts.sidebar')

@section('title', 'Admins')

@section('content')
  <h1 class="text-5xl font-bold mb-6 text-center">Admins</h1>

  {{-- Success message --}}
  @include('components.success')
  @if ($admins->isEmpty())
      <p class="text-center text-gray-600 mt-4">No admins available.</p>
  @else
      <div class="overflow-x-auto">
          <table class="min-w-full bg-white text-left border-separate border-spacing-y-2">
              <thead class="bg-indigo-600 text-white">
                  <tr>
                      <th class="px-6 py-3">Profile</th>
                      <th class="px-6 py-3">Username</th>
                      <th class="px-6 py-3">Email</th>
                      <th class="px-6 py-3">Edit</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($admins as $admin)
                      <tr class="border-b border-indigo-200 hover:bg-gray-50">
                          <td class="px-6 py-4">
                              <img src="{{ asset('storage/' . $admin->image_path) }}" alt="Admin Image" class="w-12 h-12 object-cover rounded-full">
                          </td>
                          <td class="px-6 py-4">{{ $admin->username }}</td>
                          <td class="px-6 py-4">{{ $admin->email }}</td>
                          <td class="px-6 py-4">
                              <div class="flex space-x-4 items-center">
                                  <a href="{{ url('/admin/data_admin/' . $admin->id . '/detail') }}" class="text-indigo-600 hover:underline">
                                      ✎
                                  </a>
                                  <form onsubmit="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-delete-confirm', { detail: { action: this } }))" method="POST" action="{{ url('/admin/data_admin/' . $admin->id) }}">
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
      <div class="mt-6 flex justify-center">
          {{ $admins->links() }}
      </div>
  @endif

  <div class="mt-10 flex justify-center">
      <a href="{{ url('/admin/data_admin/create') }}"
         class="flex items-center gap-2 px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white font-semibold rounded-2xl shadow-lg">
          <span class="text-2xl">+</span> Add Admin
      </a>
  </div>
@endsection