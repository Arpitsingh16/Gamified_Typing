// fallback words
if (!window.words || !Array.isArray(window.words) || window.words.length === 0) {
    window.words = ["test", "demo", "speed", "slice"];
}

document.addEventListener("DOMContentLoaded", () => {
    const gameArea = document.getElementById("gameArea");
    const startBtn = document.getElementById("startBtn");
    const scoreEl = document.getElementById("score");
    const messageEl = document.getElementById("message");
    const resultBox = document.getElementById("resultBox");

    const gunshot = new Audio("/sounds/gunshot.mp3");

    let activeWords = [];
    let score = 0;
    let spawnTimer;
    let gameActive = false;

    function startGame() {
        gameActive = true;
        score = 0;
        scoreEl.textContent = score;
        resultBox.style.display = "none";

        activeWords.forEach(w => w.el.remove());
        activeWords = [];
        messageEl.classList.add("hidden");

        spawnWord();
        spawnTimer = setInterval(spawnWord, 1500);
    }

    function endGame() {
        gameActive = false;
        clearInterval(spawnTimer);

        activeWords.forEach(w => w.el.remove());
        activeWords = [];

        resultBox.innerHTML = `<strong>Game Over</strong><br>Your Score: ${score}`;
        resultBox.style.display = "block";
    }

    function spawnWord() {
        if (!gameActive) return;

        const wordText = words[Math.floor(Math.random() * words.length)];
        const wordType = Math.random() > 0.5 ? "sniper" : "slice";

        const el = document.createElement("div");
        el.textContent = wordText;
        el.className = `word ${wordType}`;
        el.style.left = Math.random() * (gameArea.clientWidth - 100) + "px";
        el.style.top = "0px";

        gameArea.appendChild(el);

        activeWords.push({
            el,
            text: wordText,
            type: wordType,
            y: 0
        });

        fallWord(el);
    }

    function fallWord(el) {
        const obj = activeWords.find(w => w.el === el);

        const fall = setInterval(() => {
            if (!gameActive) {
                clearInterval(fall);
                return;
            }

            obj.y += 0.4;
            obj.el.style.top = obj.y + "px";

            if (obj.y > gameArea.clientHeight - 40) {
                obj.el.remove();
                activeWords = activeWords.filter(w => w.el !== obj.el);
                clearInterval(fall);
            }
        }, 16);
    }

    /* ⭐ PARTICLE EXPLOSION ⭐ */
    function explodeAtWord(element) {
        const rect = element.getBoundingClientRect();
        const areaRect = gameArea.getBoundingClientRect();

        const centerX = rect.left - areaRect.left + rect.width / 2;
        const centerY = rect.top - areaRect.top + rect.height / 2;

        explode(centerX, centerY);
    }

    function explode(x, y) {
        for (let i = 0; i < 18; i++) {
            const p = document.createElement("div");
            p.className = "particle";
            p.style.left = x + "px";
            p.style.top = y + "px";
            gameArea.appendChild(p);

            const angle = Math.random() * Math.PI * 2;
            const dist = 40 + Math.random() * 40;

            const dx = Math.cos(angle) * dist;
            const dy = Math.sin(angle) * dist;

            requestAnimationFrame(() => {
                p.style.transform = `translate(${dx}px, ${dy}px) scale(0.4)`;
                p.style.opacity = "0";
            });

            setTimeout(() => p.remove(), 420);
        }
    }

    /* KEY LOGIC */
    document.addEventListener("keydown", (e) => {
        if (!gameActive) return;

        if (e.key === "Enter") {
            e.preventDefault();
            e.stopPropagation();
            endGame();
            return;
        }

        const key = e.key.toLowerCase();

        for (let i = 0; i < activeWords.length; i++) {
            const w = activeWords[i];

            if (w.text.startsWith(key)) {
                w.text = w.text.slice(1);
                w.el.textContent = w.text;

 if (w.text.length === 0) {
    score += w.type === "sniper" ? 2 : 1;
    scoreEl.textContent = score;

    gunshot.currentTime = 0;
    gunshot.play();

    explodeAtWord(w.el);

    // visual destruction
    w.el.classList.add("destroyed");

    setTimeout(() => {
        w.el.remove();
    }, 400);

    activeWords.splice(i, 1);
}

                break;
            }
        }
    });

    startBtn.addEventListener("click", startGame);
});
