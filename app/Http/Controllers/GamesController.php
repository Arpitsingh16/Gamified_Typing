<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    // Show Games Hub
    public function index()
    {
        $user = Auth::user();
        return view('games.index', compact('user'));
    }

    // Optional: could add individual game methods here if needed
    // e.g., Bubble Typing, Sentence Rush
}
