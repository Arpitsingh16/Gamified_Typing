@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-gray-800 via-gray-900 to-black rounded-xl p-10 shadow-2xl border border-cyan-600 max-w-4xl mx-auto">
    <h1 class="text-5xl text-cyan-400 font-extrabold mb-3 tracking-widest drop-shadow-lg select-text">
        Welcome, <span class="underline decoration-pink-500">{{ $user->name }}</span>
    </h1>
    <p class="text-gray-400 mb-6 text-xl select-text">Level: <span class="font-semibold text-pink-500">{{ $user->level }}</span></p>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8 text-center">
        <a href="{{ route('typing.index') }}" class="block bg-cyan-600 hover:bg-cyan-700 transition duration-300 rounded-lg py-4 font-bold text-lg shadow-lg shadow-cyan-500/50 transform hover:scale-110">
            Start Typing Test
        </a>
        <a href="{{ route('leaderboard.index') }}" class="block bg-pink-600 hover:bg-pink-700 transition duration-300 rounded-lg py-4 font-bold text-lg shadow-lg shadow-pink-500/50 transform hover:scale-110">
            Leaderboard
        </a>
        <a href="{{ route('achievements.index') }}" class="block bg-purple-600 hover:bg-purple-700 transition duration-300 rounded-lg py-4 font-bold text-lg shadow-lg shadow-purple-500/50 transform hover:scale-110">
            Achievements
        </a>
        <a href="{{ route('games.index') }}" class="block bg-yellow-600 hover:bg-yellow-700 transition duration-300 rounded-lg py-4 font-bold text-lg shadow-lg shadow-yellow-500/50 transform hover:scale-110">
            Games 🎮
        </a>
    </div>
</div>
@endsection
