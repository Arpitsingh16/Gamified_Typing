@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold mb-4 text-center">Leaderboard</h2>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-700 text-gray-300">
                <th class="p-3">Rank</th>
                <th class="p-3">User</th>
                <th class="p-3">Avg WPM</th>
                <th class="p-3">Accuracy (%)</th>
                <th class="p-3">Tests</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaders as $index => $leader)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $leader->user->name }}</td>
                    <td class="p-3">{{ $leader->avg_wpm }}</td>
                    <td class="p-3">{{ $leader->avg_accuracy }}</td>
                    <td class="p-3">{{ $leader->tests }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
