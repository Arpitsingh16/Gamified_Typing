@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <h1 class="text-3xl font-bold text-cyan-300 mb-4 text-center">Bubble Typing Game</h1>

    <div class="flex justify-center mb-4">
        <button id="startBtn" class="px-6 py-2 bg-cyan-500 rounded-lg text-white font-bold hover:bg-cyan-600">Start Game</button>
    </div>

    <div id="gameArea" class="relative bg-gray-900 w-full h-[300px] rounded-xl overflow-hidden border-4 border-cyan-400 mx-auto mb-4"></div>

    <div class="text-center text-white text-2xl mb-4">
        Score: <span id="score">0</span>
    </div>

    <div id="results" class="text-center text-cyan-400 text-xl hidden">
        <p>Your session ended!</p>
        <p>Final WPM: <span id="finalWpm"></span></p>
    </div>

    <audio id="popSound" src="{{ asset('sounds/bubble-pop.mp3') }}"></audio>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/bubble.js') }}"></script>
@endsection
