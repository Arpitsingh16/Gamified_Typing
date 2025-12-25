document.addEventListener('DOMContentLoaded', () => {
    const gameArea = document.getElementById('gameArea');
    const startBtn = document.getElementById('startBtn');
    const scoreEl = document.getElementById('score');
    const popSfx = document.getElementById("popSound");
    const results = document.getElementById('results');
    const finalWpmEl = document.getElementById('finalWpm');

    let letters = [];
    let score = 0;
    let startTime;
    let spawnInterval;
    let gameLoopId;
    let speedMultiplier = 1;
    let gameActive = false;

    // Spawn floating bubble with centered letter
    function spawnLetter() {
        const letter = String.fromCharCode(65 + Math.floor(Math.random() * 26));

        const bubble = document.createElement('div');
        bubble.classList.add('bubble');
        bubble.textContent = letter;
        bubble.dataset.letter = letter;

        const xPos = Math.random() * (gameArea.clientWidth - 50);
        bubble.style.left = xPos + 'px';
        bubble.style.top = gameArea.clientHeight + 'px';

        gameArea.appendChild(bubble);

        letters.push({
            char: letter,
            el: bubble,
            y: gameArea.clientHeight
        });
    }

    // Update falling bubbles
    function updateLetters() {
        letters.forEach((obj, i) => {
            obj.y -= 1 * speedMultiplier;
            obj.el.style.top = obj.y + 'px';

            if (obj.y < -50) {
                obj.el.remove();
                letters.splice(i, 1);
            }
        });
    }

    // Smooth animation loop
    function gameLoop() {
        if (!gameActive) return;

        const elapsed = (Date.now() - startTime) / 1000;
        speedMultiplier = 1 + elapsed / 30;

        updateLetters();
        gameLoopId = requestAnimationFrame(gameLoop);
    }

    // Start game
    function startGame() {
        // Reset
        letters.forEach(l => l.el.remove());
        letters = [];

        score = 0;
        scoreEl.textContent = score;

        results.classList.add('hidden');
        finalWpmEl.textContent = '';

        startTime = Date.now();
        gameActive = true;

        spawnInterval = setInterval(spawnLetter, 1500);

        gameLoop();
    }

    // End game
    function endGame() {
        gameActive = false;
        clearInterval(spawnInterval);
        cancelAnimationFrame(gameLoopId);

        const elapsedMinutes = (Date.now() - startTime) / 1000 / 60;
        const wpm = Math.round(score / elapsedMinutes);

        finalWpmEl.textContent = wpm;
        results.classList.remove('hidden');

        letters.forEach(l => l.el.remove());
        letters = [];
    }

    // Key press → pop bubble
  document.addEventListener('keydown', (e) => {
    if (!gameActive) return;

    if (e.key === 'Enter') {
        e.preventDefault();
        endGame();
        return;
    }

    const key = e.key.toUpperCase();

    letters.forEach((obj, i) => {
        if (obj.char === key) {
            obj.el.classList.add('bubble-pop'); // triggers blast animation

            popSfx.currentTime = 0;
            popSfx.play();

            setTimeout(() => obj.el.remove(), 300); // match duration of blast animation

            letters.splice(i, 1);

            score++;
            scoreEl.textContent = score;
        }
    });
});


    startBtn.addEventListener('click', startGame);
});
