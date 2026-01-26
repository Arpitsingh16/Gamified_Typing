@extends('layouts.app')

@section('content')
<div class="p-6 text-white">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Achievements List</h1>
        <button class="bg-green-600 px-4 py-2 rounded hover:bg-green-700">+ Add New</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($achievements as $achievement)
        <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
            <h3 class="text-xl font-bold text-yellow-500">{{ $achievement->name }}</h3>
            <p class="text-gray-400 text-sm mb-2">{{ $achievement->description }}</p>
            <span class="text-xs bg-gray-700 px-2 py-1 rounded">Criteria: {{ $achievement->criteria_value }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection