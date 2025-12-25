@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 text-center">
    <h1 class="text-3xl font-bold text-cyan-300 mb-4">Sentence Rush</h1>

    <!-- Game Area -->
    <div id="sentenceGameArea" 
         data-sentences='@json($sentences, JSON_HEX_APOS|JSON_HEX_QUOT)' 
         class="relative bg-gray-900 w-full h-40 rounded-xl overflow-hidden border-4 border-cyan-400 mx-auto mb-4 flex items-center justify-center p-4">
        <span id="sentenceCurrentSentence" class="text-white text-xl break-words"></span>
    </div>

    <!-- Controls -->
    <div class="flex justify-center gap-4 mb-4">
        <button id="sentenceStartBtn" class="px-6 py-3 bg-cyan-500 text-white font-bold rounded-lg hover:bg-cyan-600 transition">
            Start Game
        </button>
        <span class="text-white text-xl">Time Left: <span id="sentenceTimeLeft">30</span>s</span>
    </div>

    <!-- Input -->
    <input id="sentenceTypedInput" type="text" placeholder="Type the sentence..." 
           class="w-full p-3 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 text-xl mb-4 hidden">

    <!-- Results -->
    <div id="sentenceResults" class="mt-4 hidden text-white text-xl">
        WPM: <span id="sentenceWpm">0</span> | Accuracy: <span id="sentenceAccuracy">0</span>% | Streak: <span id="sentenceStreak">0</span>
    </div>

    <!-- Optional Form to save results -->
    <form id="sentenceResultForm" method="POST" action="{{ route('sentence.store') }}">
        @csrf
        <input type="hidden" id="sentenceTypedTextInput" name="typed_text">
        <input type="hidden" id="sentenceTimeTakenInput" name="time_taken">
        <input type="hidden" id="sentenceOriginalTextInput" name="original_text">
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hidden" id="saveScoreBtn">Save Score</button>
    </form>

    <!-- Slash sound -->
    <audio id="slashSound" src="{{ asset('sounds/slash.mp3') }}"></audio>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sentence.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/sentence.js') }}"></script>
@endsection
