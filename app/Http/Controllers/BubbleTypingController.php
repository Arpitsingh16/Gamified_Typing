<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;

class BubbleTypingController extends Controller {
    public function index() {
        return view('bubble.index');
    }

    public function store(Request $request) {
        $request->validate([
            'typed_text' => 'required|numeric', // score (letters popped)
            'time_taken' => 'required|numeric|min:0.1',
        ]);

        $lettersTyped = $request->typed_text;
        $time = $request->time_taken; // in seconds

        // Calculate WPM (5 letters = 1 word)
        $wordsTyped = $lettersTyped / 5;
        $wpm = ($wordsTyped / $time) * 60;

        Result::create([
            'user_id' => Auth::id(),
            'wpm' => round($wpm),
            'accuracy' => 100, // optional
            'errors' => 0,
        ]);

        return redirect()->route('dashboard')->with('success', "Bubble game submitted! WPM: ".round($wpm));
    }
}

