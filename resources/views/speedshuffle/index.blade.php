@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12">

    <!-- Title -->
    <h1 class="text-center text-4xl font-extrabold text-cyan-400 mb-10 tracking-wide">
        Speed Letter Shuffle
    </h1>

    <!-- Game Card -->
    <div class="bg-gray-900 p-8 rounded-2xl shadow-xl border border-gray-700">

        <!-- Scrambled Word Display -->
        <div id="wordDisplay"
             class="text-center text-6xl font-bold text-white mb-8 drop-shadow-lg">
            <!-- scrambled word -->
        </div>

        <!-- Letters Box -->
        <div id="lettersBox"
             class="flex flex-wrap justify-center gap-4 mb-8">
            <!-- alphabet tiles -->
        </div>

        <!-- User Input Display -->
        <input id="userInput"
               readonly
               class="w-full p-4 bg-gray-800 text-white text-center text-2xl rounded-xl border border-gray-600 mb-8 tracking-widest"
               placeholder="Click letters to form word">

        <!-- Buttons Row -->
        <div class="flex justify-center gap-6 mb-10">
            <button id="clearBtn"
                class="px-6 py-3 bg-yellow-400 text-black font-bold rounded-xl hover:bg-yellow-500 transition shadow-md">
                Undo
            </button>

            <button id="skipBtn"
                class="px-6 py-3 bg-blue-500 text-white font-bold rounded-xl hover:bg-blue-600 transition shadow-md">
                Skip
            </button>

            <button id="exitBtn"
                class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition shadow-md">
                Exit
            </button>
        </div>

        <!-- Score -->
        <div class="text-center text-white text-2xl font-semibold">
            Score: <span id="score" class="text-cyan-400">0</span>
        </div>
    </div>

    <!-- Start Button -->
    <div class="text-center mt-10">
        <button id="startBtn"
                class="px-8 py-4 bg-cyan-500 text-white font-bold text-xl rounded-2xl hover:bg-cyan-600 transition shadow-lg">
            Start Game
        </button>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/speedshuffle.js') }}"></script>
@endsection
