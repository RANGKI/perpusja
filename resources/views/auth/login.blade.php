@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Login</h2>
        <a href="{{ url('/register') }}" class="text-blue-500 hover:underline text-sm">Don't have an account? Sign Up!</a>
    </div>

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <div class="relative">
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <a href="{{ url('/forgot-password') }}" class="absolute right-3 top-3 text-blue-500 hover:underline text-sm">Forgot Password?</a>
            </div>
            @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 text-gray-700 text-sm">Remember Me</label>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow">
            Log in
        </button>

        <div class="mt-4 text-center">
            <span class="text-gray-500 text-sm">or login with</span>
        </div>

        <button type="button" class="w-full mt-3 flex items-center justify-center border border-gray-300 rounded-lg py-2 hover:bg-gray-50">
            <img src="https://www.google.com/favicon.ico" alt="Google" class="h-5 w-5 mr-2">
            <span class="text-gray-700 font-semibold">Google</span>
        </button>
    </form>
</div>
@endsection