@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold text-red-500 mb-8 drop-shadow-lg">
        🎯 Snipe The Word
    </h1>

    <div id="gameArea" class="relative w-full h-[400px] bg-gray-900 rounded-xl border-4 border-red-500 overflow-hidden mb-6">
        <!-- Words spawn here -->
    </div>

    <button id="startBtn"
        class="px-6 py-3 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 mb-4">
        Start Game
    </button>

    <div id="resultBox"></div>


    <div class="text-white text-xl mb-2">
        Score: <span id="score">0</span>
    </div>

    <div id="message" class="text-green-400 text-lg mb-2 hidden">Word sniped!</div>
</div>
@endsection

@section('scripts')
<script>
    const words = @json($words);
</script>
<script src="{{ asset('js/sniper.js') }}" defer></script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sniper.css') }}">
@endsection
