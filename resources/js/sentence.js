document.addEventListener('DOMContentLoaded', () => {
    const gameArea = document.getElementById('sentenceGameArea');
    const startBtn = document.getElementById('sentenceStartBtn');
    const typedInput = document.getElementById('sentenceTypedInput');
    const slashSfx = document.getElementById('slashSound');
    const currentSentenceEl = document.getElementById('sentenceCurrentSentence');
    const resultsEl = document.getElementById('sentenceResults');
    const wpmEl = document.getElementById('sentenceWpm');
    const accuracyEl = document.getElementById('sentenceAccuracy');
    const streakEl = document.getElementById('sentenceStreak');
    const timeLeftEl = document.getElementById('sentenceTimeLeft');

    const typedTextInput = document.getElementById('sentenceTypedTextInput');
    const timeTakenInput = document.getElementById('sentenceTimeTakenInput');
    const originalTextInput = document.getElementById('sentenceOriginalTextInput');

    const sentencesOriginal = JSON.parse(gameArea.dataset.sentences);
    let remainingSentences = [];
    let currentSentence = '';
    let startTime;
    let timer;
    let timeLeft = 30;
    let streak = 0;
    let correctChars = 0;
    let totalChars = 0;

    function startGame() {
        streak = 0;
        correctChars = 0;
        totalChars = 0;
        timeLeft = 30;
        typedInput.value = '';
        resultsEl.classList.add('hidden');
        typedInput.classList.remove('hidden');
        typedInput.focus();
        startBtn.disabled = true;

        remainingSentences = [...sentencesOriginal];
        nextSentence();
        startTime = Date.now();

        timer = setInterval(() => {
            timeLeft--;
            timeLeftEl.textContent = timeLeft;
            if (timeLeft <= 0) endGame();
        }, 1000);
    }

    function nextSentence() {
        if (remainingSentences.length === 0) {
            endGame();
            return;
        }
        const index = Math.floor(Math.random() * remainingSentences.length);
        currentSentence = remainingSentences[index];
        remainingSentences.splice(index, 1);
        currentSentenceEl.innerHTML = currentSentence.split('').map(c => `<span>${c}</span>`).join('');
        typedInput.value = '';
    }

    function endGame() {
        clearInterval(timer);
        typedInput.classList.add('hidden');
        startBtn.disabled = false;

        const timeTaken = (Date.now() - startTime) / 1000;
        const wordsTyped = totalChars / 5;
        const wpm = Math.round(wordsTyped / (timeTaken / 60));
        const acc = totalChars > 0 ? Math.round((correctChars / totalChars) * 100) : 0;

        wpmEl.textContent = wpm;
        accuracyEl.textContent = acc;
        streakEl.textContent = streak;
        resultsEl.classList.remove('hidden');

        typedTextInput.value = currentSentence;
        timeTakenInput.value = timeTaken;
        originalTextInput.value = currentSentence;
    }

    typedInput.addEventListener('input', () => {
        const typed = typedInput.value;
        totalChars = typed.length;
        correctChars = 0;

        const letters = currentSentenceEl.querySelectorAll('span');

        for (let i = 0; i < letters.length; i++) {
            if (typed[i] === currentSentence[i]) {
                letters[i].classList.add('sliced-letter');
                correctChars++;
            }
        }

        if (typed === currentSentence) {
            streak++;
            slashSfx.currentTime = 0;
            slashSfx.play();

            setTimeout(nextSentence, 500); // wait for slice animation
        }
    });

    startBtn.addEventListener('click', startGame);
});
