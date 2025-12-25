const words = [
    "coding", "laravel", "keyboard", "shuffle", "typing",
    "bubble", "rocket", "matrix", "server", "gamer"
];

let currentWord = "";
let scrambled = "";
let score = 0;
let gameActive = true;

// DOM Elements
const wordDisplay = document.getElementById("wordDisplay");
const lettersBox = document.getElementById("lettersBox");
const userInput = document.getElementById("userInput");
const scoreBox = document.getElementById("score");
const undoBtn = document.getElementById("clearBtn");
const skipBtn = document.getElementById("skipBtn");
const exitBtn = document.getElementById("exitBtn");
const startBtn = document.getElementById("startBtn");

// Start Game
startBtn.addEventListener("click", () => {
    score = 0;
    scoreBox.textContent = score;
    gameActive = true;
    newWord();
});

// Pick new word
function newWord() {
    if (!gameActive) return;

    currentWord = words[Math.floor(Math.random() * words.length)];
    scrambled = shuffle(currentWord);

    if (scrambled === currentWord) scrambled = shuffle(currentWord);

    wordDisplay.textContent = scrambled.toUpperCase();
    userInput.value = "";

    lettersBox.innerHTML = "";
    renderButtons(scrambled);

    animateWord();
}

// Shuffle letters properly
function shuffle(str) {
    let arr = str.split("");
    for (let i = arr.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr.join("");
}

// Display clickable letter buttons
function renderButtons(text) {
    text.split("").forEach((letter, index) => {
        const btn = document.createElement("button");
        btn.textContent = letter.toUpperCase();
        btn.dataset.index = index;
        btn.className =
            "px-4 py-2 bg-gray-800 text-white rounded-lg shadow hover:bg-gray-700 transition";

        btn.addEventListener("click", () => selectLetter(btn));

        lettersBox.appendChild(btn);
    });
}

// When clicking a letter
function selectLetter(btn) {
    if (!gameActive) return;
    if (btn.classList.contains("letter-picked")) return;

    btn.classList.add("letter-picked");
    userInput.value += btn.textContent.toLowerCase();

    checkAnswer();
}

// Undo button
undoBtn.addEventListener("click", () => {
    if (!gameActive) return;

    let val = userInput.value;
    if (val.length === 0) return;

    let removedLetter = val.slice(-1);
    userInput.value = val.slice(0, -1);

    let btns = document.querySelectorAll("#lettersBox button");
    for (let b of btns) {
        if (b.textContent.toLowerCase() === removedLetter && b.classList.contains("letter-picked")) {
            b.classList.remove("letter-picked");
            break;
        }
    }
});

// Skip word
skipBtn.addEventListener("click", () => {
    if (!gameActive) return;
    userInput.value = "";
    newWord();
});

// Exit button
exitBtn.addEventListener("click", () => {
    gameActive = false;
    userInput.value = "";
    lettersBox.innerHTML = "";
    wordDisplay.textContent = "Game Stopped";
    wordDisplay.classList.add("text-red-400");

    setTimeout(() => {
        wordDisplay.classList.remove("text-red-400");
    }, 600);
});

// Check correct word
function checkAnswer() {
    if (!gameActive) return;

    if (userInput.value === currentWord) {
        score++;
        scoreBox.textContent = score;

        wordDisplay.textContent = "Correct!";
        wordDisplay.classList.add("text-green-400");

        setTimeout(() => {
            wordDisplay.classList.remove("text-green-400");
            newWord();
        }, 700);
    }
}

// Word animation
function animateWord() {
    wordDisplay.classList.add("animate-pulse");
    setTimeout(() => {
        wordDisplay.classList.remove("animate-pulse");
    }, 500);
}

newWord();
