@extends('layouts.sidebar')

@section('title', 'Personal Accounts')

@section('content')
  <h1 class="text-5xl font-bold mb-6 text-center">Personal Accounts</h1>
    {{-- Success message --}}
    @include('components.success')
    @include('components.error')

  @if ($users->isEmpty())
      <p class="text-center text-gray-600 mt-4">No user accounts available.</p>
  @else
      <div class="overflow-x-auto">
          <table class="min-w-full bg-white rounded shadow text-left">
              <thead class="bg-[#3D3BA0] text-white">
                  <tr>
                      <th class="px-6 py-3">Profile</th>
                      <th class="px-6 py-3">Username</th>
                      <th class="px-6 py-3">Email</th>
                      <th class="px-6 py-3">No. Telepon</th>
                      <th class="px-6 py-3">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                      <tr class="border-b hover:bg-gray-100">
                          <td class="px-6 py-4">
                              <img src="{{ asset('storage/' . $user->image_path) }}" alt="Profile Image" class="w-12 h-12 object-cover rounded-full">
                          </td>
                          <td class="px-6 py-4">{{ $user->username }}</td>
                          <td class="px-6 py-4">{{ $user->email }}</td>
                          <td class="px-6 py-4">{{ $user->phone_number }}</td>
                          <td class="px-6 py-4">
                              <div class="flex space-x-4 items-center">
                                  <a href="{{ url('/admin/data_personal/' . $user->id . '/detail') }}" class="text-indigo-600 hover:underline">
                                      View Details
                                  </a>
                                  <form onsubmit="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-delete-confirm', { detail: { action: this } }))" method="POST" action="{{ url('/admin/data_personal/' . $user->id) }}">
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
          {{ $users->links() }}
      </div>
  @endif
@endsection