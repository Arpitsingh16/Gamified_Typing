@extends('layouts.app')

@section('content')
<div class="relative max-w-4xl mx-auto bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-3xl p-12 shadow-2xl border border-cyan-700 overflow-hidden select-none font-mono">

    <!-- Animated background -->
    <div class="absolute top-12 left-20 w-40 h-40 bg-cyan-600 rounded-full opacity-30 blur-3xl animate-pulse mix-blend-screen"></div>
    <div class="absolute bottom-10 right-16 bg-pink-600 w-56 h-56 rounded-full opacity-20 blur-2xl animate-pulse animation-delay-5000 mix-blend-screen"></div>

    <h2 class="text-5xl font-extrabold mb-8 text-cyan-400 drop-shadow-lg">🚀 Gamified Typing</h2>
    <p class="text-gray-400 text-lg mb-10 font-mono select-none">Improve your speed and accuracy like a pro. Login or Register to save your progress.</p>

    <div id="typingContainer" class="bg-gray-900 rounded-2xl p-8 text-2xl md:text-3xl font-mono leading-relaxed border-4 border-transparent focus-within:border-cyan-400 transition shadow-xl text-gray-400 relative z-10 min-h-[140px]">
        <span id="testText" class="select-text"></span>
    </div>

    <textarea
        id="typedInput"
        class="w-full mt-6 p-5 h-36 bg-gray-900 text-white rounded-xl focus:outline-none focus:ring-4 focus:ring-cyan-400 font-mono text-xl resize-none shadow-inner tracking-wide placeholder-gray-500 transition duration-300"
        placeholder="Start typing here..."
        autofocus
    ></textarea>

    <div class="h-1 w-full bg-gray-700 rounded-full mt-6 relative overflow-hidden">
        <div id="timerBar" class="h-full bg-cyan-400 rounded-full transition-all duration-1000 ease-linear"></div>
    </div>

    <div id="liveStats" class="mt-8 flex justify-center gap-12 text-gray-300 font-semibold opacity-80 select-none text-xl tracking-widest">
        <div>WPM: <span id="liveWpm">0</span></div>
        <div>Accuracy: <span id="liveAcc">100%</span></div>
        <div>Errors: <span id="liveErrors">0</span></div>
    </div>

    <div id="results" class="mt-12 text-center bg-gray-800 bg-opacity-75 backdrop-blur-md rounded-3xl p-8 shadow-2xl text-cyan-400 hidden animate-fadeIn">
        <p class="text-4xl font-extrabold mb-6">🎉 Your Results:</p>
        <p id="wpm" class="text-3xl mb-4"></p>
        <p id="accuracy" class="text-2xl mb-4"></p>
        <p id="errors" class="text-2xl"></p>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/welcome.js') }}"></script>
@endsection
