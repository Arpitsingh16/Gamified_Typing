@extends('layouts.app')

@section('content')
<div class="relative max-w-4xl mx-auto bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-3xl p-12 shadow-2xl border border-cyan-700 overflow-hidden select-none font-mono">

    <!-- Animated background -->
    <div class="absolute top-12 left-20 w-40 h-40 bg-cyan-600 rounded-full opacity-30 blur-3xl animate-pulse mix-blend-screen"></div>
    <div class="absolute bottom-10 right-16 bg-pink-600 w-56 h-56 rounded-full opacity-20 blur-2xl animate-pulse animation-delay-5000 mix-blend-screen"></div>

    <h2 class="text-5xl font-extrabold mb-8 text-cyan-400 drop-shadow-lg">🚀 Gamified Typing Challenge</h2>
    <p class="text-gray-400 text-lg mb-10 font-mono select-none">Improve your speed and accuracy like a pro. Login or Register to save your progress.</p>

    <div id="typingContainer" class="bg-gray-900 rounded-2xl p-8 text-2xl md:text-3xl font-mono leading-relaxed border-4 border-transparent focus-within:border-cyan-400 transition shadow-xl text-gray-400 relative z-10 min-h-[140px]">
        <span id="testText" class="select-text"></span>
    </div>

    <textarea id="typedInput" class="w-full mt-6 p-5 h-36 bg-gray-900 text-white rounded-xl focus:outline-none focus:ring-4 focus:ring-cyan-400 font-mono text-xl resize-none shadow-inner tracking-wide placeholder-gray-500 transition duration-300" placeholder="Start typing here..." autofocus></textarea>

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

<style>
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(12px);}
    to {opacity: 1; transform: translateY(0);}
}
.animate-fadeIn {
    animation: fadeIn 0.6s ease forwards;
}
#testText span {
    transition: color 0.3s ease, background-color 0.3s ease;
    color: #9CA3AF; /* Tailwind gray-400 */
    padding: 0 3px;
    user-select: text;
}
#testText span.correct {
    color: #6EE7B7; /* Tailwind green-400 */
    background-color: rgba(34,197,94,0.2);
    border-radius: 4px;
}
#testText span.incorrect {
    color: #F87171; /* Tailwind red-400 */
    background-color: rgba(239,68,68,0.25);
    border-radius: 4px;
    text-decoration: underline wavy red;
}
textarea:focus {
    box-shadow: 0 0 20px 3px #22D3EE;
    border-radius: 12px;
}
</style>

<script>
const typedInput = document.getElementById('typedInput');
const testText = document.getElementById('testText');
const results = document.getElementById('results');
const wpmEl = document.getElementById('wpm');
const accEl = document.getElementById('accuracy');
const errEl = document.getElementById('errors');
const liveWpm = document.getElementById('liveWpm');
const liveAcc = document.getElementById('liveAcc');
const liveErrors = document.getElementById('liveErrors');
const timerBar = document.getElementById('timerBar');

let typingStarted = false;
let startTime, timerRunning = false;
const testDuration = 60; // seconds
let timerInterval;

const words = [
    "the quick brown fox jumps over the lazy dog",
    "typing speed tests improve accuracy and focus",
    "coding in laravel makes backend development fun",
    "dark mode improves concentration for long sessions",
    "always practice daily to become faster and sharper",
    "efficiency comes from consistency and good habits"
];

function generateLine() {
    const line = [];
    while (line.join(' ').split(' ').length < 25) {
        line.push(words[Math.floor(Math.random() * words.length)]);
    }
    const text = line.join(' ');
    return text.split('').map(char => `<span>${char}</span>`).join('');
}

// Preload text immediately on page load
document.addEventListener('DOMContentLoaded', () => {
    testText.innerHTML = generateLine();
});

function highlightTyped() {
    const input = typedInput.value.split('');
    const spans = testText.querySelectorAll('span');

    spans.forEach((span, i) => {
        if (i < input.length) {
            if (input[i] === span.textContent) {
                span.classList.add('correct');
                span.classList.remove('incorrect');
            } else {
                span.classList.add('incorrect');
                span.classList.remove('correct');
            }
        } else {
            span.classList.remove('correct');
            span.classList.remove('incorrect');
        }
    });

    updateLiveStats();
}

function updateLiveStats() {
    const inputText = typedInput.value.trim();
    const reference = testText.textContent.trim();
    const inputWords = inputText.split(/\s+/);
    const refWords = reference.split(/\s+/);

    let correct = 0;
    let errors = 0;
    for (let i = 0; i < inputWords.length; i++) {
        if (inputWords[i] === refWords[i]) correct++;
        else errors++;
    }

    const timeTaken = (Date.now() - startTime) / 1000 / 60;
    const wpm = Math.round((inputWords.length / timeTaken) || 0);
    const accuracy = Math.round((correct / refWords.length) * 100);

    liveWpm.textContent = wpm;
    liveAcc.textContent = accuracy + "%";
    liveErrors.textContent = errors;
}

function calculateResults() {
    const inputText = typedInput.value.trim();
    const reference = testText.textContent.trim();
    const inputWords = inputText.split(/\s+/);
    const refWords = reference.split(/\s+/);

    let correct = 0;
    let errors = 0;
    for (let i = 0; i < inputWords.length; i++) {
        if (inputWords[i] === refWords[i]) correct++;
        else errors++;
    }

    const timeTaken = (Date.now() - startTime) / 1000 / 60;
    const wpm = Math.round((inputWords.length / timeTaken) || 0);
    const accuracy = Math.round((correct / refWords.length) * 100);

    wpmEl.textContent = "WPM: " + wpm;
    accEl.textContent = "Accuracy: " + accuracy + "%";
    errEl.textContent = "Errors: " + errors;
    results.classList.remove('hidden');
}

function startTimer() {
    let timeLeft = testDuration;
    timerBar.style.width = '100%';

    timerInterval = setInterval(() => {
        timeLeft--;
        const progressPercent = (timeLeft / testDuration) * 100;
        timerBar.style.width = progressPercent + '%';

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            endTest();
        }
    }, 1000);
}

function endTest() {
    if (!timerRunning) return;
    timerRunning = false;
    typedInput.disabled = true;
    calculateResults();
    clearInterval(timerInterval);
    timerBar.style.width = '0%';
}

// Auto-start timer on first input
typedInput.addEventListener('input', () => {
    if (!typingStarted) {
        typingStarted = true;
        startTime = Date.now();
        timerRunning = true;
        results.classList.add('hidden');
        startTimer();
    }
    highlightTyped();
});
</script>
@endsection
