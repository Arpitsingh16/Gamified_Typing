<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Achievement;
use App\Models\UserAchievement;
use App\Models\Result;

class AchievementController extends Controller {
    public function index() {
        $user = Auth::user();
        $allAchievements = Achievement::all();
        $userAchievements = $user->achievements->pluck('id')->toArray();

        return view('achievements.index', compact('allAchievements', 'userAchievements'));
    }

 public static function checkAndUnlock($user) {
    $results = $user->results;
    $avgWpm = $results->avg('wpm') ?? 0;
    $avgAccuracy = $results->avg('accuracy') ?? 0;
    $totalTests = $results->count();
    $totalWpmSum = $results->sum('wpm');

    // Define achievements and conditions
    $conditions = [
        'Speed Demon'      => fn() => $avgWpm >= 80,
        'Accuracy Pro'     => fn() => $avgAccuracy >= 95,
        'Persistent Typer' => fn() => $totalTests >= 10,
        'Fast Learner'     => fn() => $avgWpm >= 60 && $totalTests >= 5,
        'Marathon Typer'   => fn() => $totalWpmSum >= 1000,
        'Night Owl'        => fn() => $results->where('created_at', '>=', now()->subHours(6))->count() >= 3,
        'Error Slayer'     => fn() => $results->avg('errors') <= 2,
        'Daily Practice'   => fn() => $results->whereBetween('created_at', [now()->subDays(6), now()])->count() >= 7,
    ];

    foreach ($conditions as $name => $check) {
        // Ensure achievement exists in DB
        $achievement = Achievement::firstOrCreate(
            ['name' => $name],
            ['description' => 'Unlocked for ' . strtolower($name)]
        );

        // Unlock achievement if condition is met and not already unlocked
        if ($check() && !$user->achievements->contains($achievement->id)) {
            UserAchievement::create([
                'user_id' => $user->id,
                'achievement_id' => $achievement->id,
            ]);
        }
    }
}

}
