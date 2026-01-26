@extends('layouts.app')

@section('content')
<div class="p-6 text-white">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">User Performance Results</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-700 px-4 py-2 rounded text-sm">Back</a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="p-4">User</th>
                    <th class="p-4">WPM</th>
                    <th class="p-4">Accuracy</th>
                    <th class="p-4">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($results as $result)
                    <tr class="hover:bg-gray-750 transition">
                        <td class="p-4">{{ $result->user->name }}</td>
                        <td class="p-4 text-green-400 font-bold">{{ $result->wpm }}</td>
                        <td class="p-4">{{ $result->accuracy }}%</td>
                        <td class="p-4 text-gray-400">{{ $result->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">No results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection