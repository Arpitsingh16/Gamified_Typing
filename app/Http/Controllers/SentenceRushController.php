<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;

class SentenceRushController extends Controller {
    public function index() {
        $sentences = [
            "The quick brown fox jumps over the lazy dog",
            "Laravel makes web development clean and simple",
            "Typing fast requires accuracy and focus",
            "Practice consistently to improve performance",
            "Consistency beats intensity over long periods"
        ];
        return view('sentence.index', compact('sentences'));
    }

    public function store(Request $request) {
        $request->validate([
            'typed_text' => 'required|string',
            'time_taken' => 'required|numeric|min:1',
        ]);

        $typed = trim($request->typed_text);
        $time = $request->time_taken;

        $wordsTyped = str_word_count($typed);
        $wpm = ($wordsTyped / $time) * 60;

        Result::create([
            'user_id' => Auth::id(),
            'wpm' => round($wpm),
            'accuracy' => 100, // can calculate properly later if needed
            'errors' => 0,
        ]);

        return redirect()->route('sentence.index')->with('success', 'Sentence Rush session submitted!');
    }
}
