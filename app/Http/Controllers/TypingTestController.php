<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;

class TypingTestController extends Controller {
    public function index() {
        $paragraphs = [
            "The quick brown fox jumps over the lazy dog.",
            "Laravel makes web development clean and simple.",
            "Typing fast requires accuracy and focus, not just speed.",
            "Practice consistently to improve your typing performance."
        ];
        $text = $paragraphs[array_rand($paragraphs)];
        return view('typing.index', compact('text'));
    }

public function store(Request $request) {
    $request->validate([
        'original_text' => 'required|string',
        'typed_text' => 'required|string',
        'time_taken' => 'required|numeric|min:1',
    ]);

    $original = trim($request->original_text);
    $typed = trim($request->typed_text);
    $time = $request->time_taken;

    $original_words = str_word_count($original);
    $typed_words = str_word_count($typed);
    $correct_chars = similar_text($original, $typed);
    $total_chars = strlen($original);
    $errors = max(0, $total_chars - $correct_chars);

    $accuracy = $total_chars > 0 ? ($correct_chars / $total_chars) * 100 : 0;
    $wpm = ($typed_words / $time) * 60;

    $result = Result::create([
        'user_id' => Auth::id(),
        'wpm' => round($wpm),
        'accuracy' => round($accuracy, 2),
        'errors' => $errors,
    ]);

    $user = Auth::user();
    \App\Http\Controllers\AchievementController::checkAndUnlock($user);

    return redirect()->route('dashboard')->with('success', 'Typing test submitted successfully!');
}

}
