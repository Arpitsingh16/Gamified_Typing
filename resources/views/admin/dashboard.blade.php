@extends('layouts.app')

@section('content')
<div class="p-6 text-white">
    <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>

<div class="grid grid-cols-2 gap-4">
        <a href="{{ route('admin.users') }}" class="bg-blue-600 p-4 rounded hover:bg-blue-700 transition">Manage Users</a>
        <a href="{{ route('admin.results') }}" class="bg-purple-600 p-4 rounded hover:bg-purple-700 transition">View Results</a>
        <a href="{{ route('admin.achievements') }}" class="bg-green-600 p-4 rounded hover:bg-green-700 transition">Achievements</a>
        <a href="{{ route('admin.settings') }}" class="bg-red-600 p-4 rounded hover:bg-red-700 transition">Game Settings</a>
    </div>

    <div class="grid grid-cols-2 gap-4">
    </div>
</div>
@endsection
