@extends('layouts.app')

@section('content')
<div class="p-6 text-white max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">Edit User: <span class="text-blue-400">{{ $user->name }}</span></h1>
        <a href="{{ route('admin.users') }}" class="text-gray-400 hover:text-white">Cancel</a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-gray-800 p-8 rounded-xl border border-gray-700 space-y-6">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-400">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                   class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 outline-none">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-400">Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 outline-none">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Role --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-400">System Role</label>
            <select name="role" class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3 text-white focus:border-blue-500 outline-none">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Standard Access)</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Full Control)</option>
            </select>
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg transition duration-200">
                Update User Profile
            </button>
        </div>
    </form>
</div>
@endsection