@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold text-cyan-400 mb-10 drop-shadow-lg">
        🎮 Games Hub
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Bubble Typing -->
        <a href="{{ route('bubble.index') }}" 
           class="group relative block bg-green-600 rounded-xl py-8 font-bold text-2xl text-white shadow-lg shadow-green-500/50 transform transition duration-300 hover:scale-105 hover:bg-green-700">
            <span class="absolute -top-4 -right-4 bg-white text-green-600 font-bold px-3 py-1 rounded-full text-sm shadow-lg group-hover:scale-110 transition transform">
                New
            </span>
            Bubble Typing
        </a>

        <!-- Sentence Rush -->
        <a href="{{ route('sentence.index') }}" 
           class="group relative block bg-orange-600 rounded-xl py-8 font-bold text-2xl text-white shadow-lg shadow-orange-500/50 transform transition duration-300 hover:scale-105 hover:bg-orange-700">
            <span class="absolute -top-4 -right-4 bg-white text-orange-600 font-bold px-3 py-1 rounded-full text-sm shadow-lg group-hover:scale-110 transition transform">
                Hot
            </span>
            Sentence Rush
        </a>

        <!-- Speed Sentence Shuffle -->
        <a href="{{ route('speedshuffle.index') }}" 
           class="group relative block bg-purple-600 rounded-xl py-8 font-bold text-2xl text-white shadow-lg shadow-purple-500/50 transform transition duration-300 hover:scale-105 hover:bg-purple-700">
            <span class="absolute -top-4 -right-4 bg-white text-purple-600 font-bold px-3 py-1 rounded-full text-sm shadow-lg group-hover:scale-110 transition transform">
                New
            </span>
            Speed Sentence Shuffle
        </a>

        <!-- Sniper Typing -->
        <a href="{{ route('sniper.index') }}" 
           class="group relative block bg-red-600 rounded-xl py-8 font-bold text-2xl text-white shadow-lg shadow-red-500/50 transform transition duration-300 hover:scale-105 hover:bg-red-700">
            <span class="absolute -top-4 -right-4 bg-white text-red-600 font-bold px-3 py-1 rounded-full text-sm shadow-lg group-hover:scale-110 transition transform">
                New
            </span>
            Sniper Typing
        </a>

    </div>
</div>
@endsection
