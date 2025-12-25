@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-900 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-center text-cyan-400">🏆 Achievements</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($allAchievements as $achievement)
            @php
                $isUnlocked = in_array($achievement->id, $userAchievements);
            @endphp
            <div 
                class="p-5 rounded-lg shadow-lg cursor-pointer select-none
                transition-all duration-300 transform hover:scale-105
                {{ $isUnlocked ? 'bg-green-700 text-white animate-bounce' : 'bg-gray-700 text-gray-400 opacity-70 hover:opacity-90' }}"
                title="{{ $achievement->description }}"
            >
                <div class="flex items-center space-x-3 mb-3">
                    <span class="text-4xl">
                        {!! $isUnlocked ? '&#x1F3C6;' /* Trophy emoji */ : '&#x1F512;' /* Lock emoji */ !!}
                    </span>
                    <h3 class="text-xl font-bold">{{ $achievement->name }}</h3>
                </div>
                <p class="text-sm leading-snug">{{ $achievement->description }}</p>
                <p class="mt-3 text-sm font-semibold">
                    {{ $isUnlocked ? 'Unlocked' : 'Locked' }}
                </p>
            </div>
        @endforeach
    </div>
</div>
@endsection
