document.addEventListener('DOMContentLoaded', () => {
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
        return text.split('').map(char => `<span class="char">${char}</span>`).join('');
    }

    let typingStarted = false;
    let startTime, timerRunning = false;
    const testDuration = 60;
    let timerInterval;

    testText.innerHTML = generateLine();


    // -------------------------
    // 1. Highlight Logic
    // -------------------------
    function highlightTyped() {
        const spans = testText.querySelectorAll("span");
        const typed = typedInput.value.split("");

        spans.forEach((span, i) => {
            span.classList.remove("correct", "wrong");

            // Force animation reset
            void span.offsetWidth;

            if (typed[i] == null) return;

            if (typed[i] === span.textContent) {
                span.classList.add("correct");
            } else {
                span.classList.add("wrong");
            }
        });

        updateLiveStats();
    }


    // -------------------------
    // 2. Live Stats
    // -------------------------
    function updateLiveStats() {
        const typed = typedInput.value;
        const timePassed = (Date.now() - startTime) / 1000 || 1;

        const wordsTyped = typed.trim().split(/\s+/).length;
        const wpm = Math.round((wordsTyped / timePassed) * 60);

        const spans = testText.querySelectorAll("span");
        let correct = 0, total = typed.length;

        typed.split("").forEach((ch, i) => {
            if (spans[i] && spans[i].textContent === ch) correct++;
        });

        const accuracy = total > 0 ? Math.round((correct / total) * 100) : 100;
        const errors = total - correct;

        liveWpm.textContent = wpm;
        liveAcc.textContent = accuracy + "%";
        liveErrors.textContent = errors;
    }


    // -------------------------
    // 3. Final Result Calc
    // -------------------------
    function calculateResults() {
        const typed = typedInput.value;
        const timePassed = testDuration;

        const wordsTyped = typed.trim().split(/\s+/).length;
        const wpm = Math.round(wordsTyped);

        const spans = testText.querySelectorAll("span");
        let correct = 0, total = typed.length;

        typed.split("").forEach((ch, i) => {
            if (spans[i] && spans[i].textContent === ch) correct++;
        });

        const accuracy = total > 0 ? Math.round((correct / total) * 100) : 100;
        const errors = total - correct;

        wpmEl.textContent = `WPM: ${wpm}`;
        accEl.textContent = `Accuracy: ${accuracy}%`;
        errEl.textContent = `Errors: ${errors}`;
    }


    // -------------------------
    // 4. Timer Logic
    // -------------------------
    function startTimer() {
        let timeLeft = testDuration;

        timerInterval = setInterval(() => {
            timeLeft--;

            const progress = ((testDuration - timeLeft) / testDuration) * 100;
            timerBar.style.width = progress + "%";

            if (timeLeft <= 0) endTest();
        }, 1000);
    }


    // -------------------------
    // 5. End Test
    // -------------------------
function endTest() {
    clearInterval(timerInterval);
    timerRunning = false;

    calculateResults();
    results.classList.remove("hidden");

    // SEND TO BACKEND
    document.getElementById("originalTextInput").value = testText.innerText;
    document.getElementById("typedTextInput").value = typedInput.value;
    document.getElementById("timeTakenInput").value = testDuration;

    document.getElementById("resultForm").submit();
}



    // -------------------------
    // 6. Input Listener
    // -------------------------
    typedInput.addEventListener('input', () => {
        if (!typingStarted) {
            typingStarted = true;
            startTime = Date.now();
            timerRunning = true;
            results.classList.add('hidden');
            startTimer();
        }
        highlightTyped();

        // End test instantly on ENTER
if (typedInput.value.endsWith("\n")) {
    typedInput.value = typedInput.value.replace("\n", ""); // remove the newline
    endTest();
}

    });
});
