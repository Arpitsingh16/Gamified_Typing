document.addEventListener("DOMContentLoaded", function () {
    const typedInput = document.getElementById("typedInput");
    const testText = document.getElementById("testText");

    const wordsList = [
        "the quick brown fox",
        "jumps over the lazy dog",
        "coding in laravel is fun",
        "practice makes perfect",
        "typing games improve speed",
    ];

    let currentText = "";
    let currentSentenceIndex = 0;

    function loadText() {
        currentText = wordsList[currentSentenceIndex % wordsList.length];
        const words = currentText.split(" ");

        testText.innerHTML = words
            .map(
                (word, idx) =>
                    `<span class="word" data-index="${idx}">${word}</span>`
            )
            .join(" ");

        typedInput.value = "";
    }

    loadText();

    typedInput.addEventListener("input", () => {
        const inputVal = typedInput.value;
        const spans = testText.querySelectorAll("span.word");

        const targetWords = currentText.split(" ");
        const typedWords = inputVal.trim().split(" ").filter((w) => w.length > 0);

        // Index of word currently being typed
        const currentWordIndex = Math.max(typedWords.length - 1, 0);
        const currentTypedWord = typedWords[currentWordIndex] || "";
        const currentTargetWord = targetWords[currentWordIndex] || "";

        // Highlight characters (correct / incorrect) for current word
        spans.forEach((span, idx) => {
            const word = targetWords[idx];
            const chars = word.split("");

            // If this is the active word, compare with typed chars for that word
            if (idx === currentWordIndex) {
                const typedForThisWord = currentTypedWord.split("");

                span.innerHTML = chars
                    .map((char, cIdx) => {
                        if (typedForThisWord[cIdx] == null) {
                            return `<span>${char}</span>`;
                        }
                        if (typedForThisWord[cIdx] === char) {
                            return `<span class="correct">${char}</span>`;
                        }
                        return `<span class="incorrect">${char}</span>`;
                    })
                    .join("");
            } else {
                // Non-active words: just plain text
                span.innerHTML = chars.map((c) => `<span>${c}</span>`).join("");
            }
        });

        // When user finishes a word (space pressed) and it is correct -> fade
        if (inputVal.endsWith(" ") && currentTypedWord === currentTargetWord) {
            const spanToFade = testText.querySelector(
                `span.word[data-index="${currentWordIndex}"]`
            );
            if (spanToFade && !spanToFade.classList.contains("word-fade")) {
                spanToFade.classList.add("word-fade");
            }

            // If last word also completed, move to next sentence
            const isLastWord = currentWordIndex === targetWords.length - 1;
            if (isLastWord) {
                setTimeout(() => {
                    currentSentenceIndex++;
                    loadText();
                }, 600); // matches fade animation
            }
        }
    });
});
