@extends('layouts.sidebar')

@section('title', 'Personal Accounts')

@section('content')
  <h1 class="text-5xl font-bold mb-6">Personal Accounts</h1>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow text-left">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-6 py-3">Profile</th>
          <th class="px-6 py-3">Username</th>
          <th class="px-6 py-3">Email</th>
          <th class="px-6 py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr class="border-b hover:bg-gray-100">
            <td class="px-6 py-4">
              <img src="{{ asset('storage/' . $user->path_profile) }}" class="w-12 h-12 object-cover rounded-full">
            </td>
            <td class="px-6 py-4">{{ $user->username }}</td>
            <td class="px-6 py-4">{{ $user->email }}</td>
            <td class="px-6 py-4">{{ $user->no_telepon }}</td>
            <td class="px-6 py-4">
              <a href="{{ url('/data_personal/' . $user->account_id . '/detail') }}" class="text-indigo-600 hover:underline">
                View Details
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
