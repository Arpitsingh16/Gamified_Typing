<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller {
    public function index() {
        $leaders = Result::select('user_id', 
                DB::raw('ROUND(AVG(wpm),2) as avg_wpm'), 
                DB::raw('ROUND(AVG(accuracy),2) as avg_accuracy'), 
                DB::raw('COUNT(*) as tests'))
            ->groupBy('user_id')
            ->orderByDesc('avg_wpm')
            ->with('user')
            ->take(20)
            ->get();

        return view('leaderboard.index', compact('leaders'));
    }
}
