@extends('layouts.app')

@section('content')

@if(auth()->check())
    <h1 class="text-3xl font-bold text-cyan-300 mb-6">
        Welcome, {{ auth()->user()->name }}
    </h1>
@endif


<div class="typing-test-container max-w-4xl mx-auto p-8">
    <h2 class="text-4xl font-bold text-cyan-400 mb-6">🚀 Gamified Typing Challenge</h2>
    <p class="text-gray-400 mb-8 select-none">Improve your speed and accuracy like a pro. Login or Register to save your progress.</p>

    <div id="typingContainer" class="bg-gray-900 rounded-2xl p-6 text-2xl font-mono leading-relaxed border-4 border-transparent focus-within:border-cyan-400 transition shadow-lg text-gray-400 relative min-h-[140px]">
        <span id="testText" class="select-text"></span>
    </div>

    <textarea id="typedInput" class="w-full mt-6 p-5 h-36 bg-gray-900 text-white rounded-xl focus:outline-none focus:ring-4 focus:ring-cyan-400 font-mono text-xl resize-none shadow-inner tracking-wide placeholder-gray-500 transition duration-300"
        placeholder="Start typing here..." autofocus></textarea>

    <div id="timerBarContainer" class="h-1 w-full bg-gray-700 rounded-full mt-6 relative overflow-hidden">
        <div id="timerBar" class="h-full bg-cyan-400 rounded-full transition-all duration-1000 ease-linear"></div>
    </div>

    <div id="liveStats" class="mt-8 flex justify-center gap-8 text-gray-300 font-semibold opacity-80 select-none text-lg">
        <div>WPM: <span id="liveWpm">0</span></div>
        <div>Accuracy: <span id="liveAcc">100%</span></div>
        <div>Errors: <span id="liveErrors">0</span></div>
    </div>

    <div id="results" class="mt-12 text-center bg-gray-800 bg-opacity-75 backdrop-blur-md rounded-xl p-8 shadow-lg text-cyan-400 hidden animate-fadeIn">
        <p class="text-3xl font-bold mb-4">🎉 Your Results:</p>
        <p id="wpm"></p>
        <p id="accuracy"></p>
        <p id="errors"></p>
    </div>

    <form id="resultForm" action="{{ route('typing.store') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="original_text" id="originalTextInput">
    <input type="hidden" name="typed_text" id="typedTextInput">
    <input type="hidden" name="time_taken" id="timeTakenInput">
</form>

</div>
@endsection
