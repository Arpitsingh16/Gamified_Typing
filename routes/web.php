<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypingTestController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BubbleTypingController;
use App\Http\Controllers\SentenceRushController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\SpeedShuffleController;
use App\Http\Controllers\SniperController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;








Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Laravel is working';
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/typing-test', [TypingTestController::class, 'index'])->name('typing.index');
    Route::post('/typing-test/submit', [TypingTestController::class, 'store'])->name('typing.store');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::get('/bubble-typing', [App\Http\Controllers\BubbleTypingController::class, 'index'])->name('bubble.index');
    Route::post('/bubble-game/submit', [BubbleTypingController::class, 'store'])->name('bubble.store');
    Route::get('/sentence-rush', [SentenceRushController::class, 'index'])->name('sentence.index');
    Route::post('/sentence-rush/submit', [SentenceRushController::class, 'store'])->name('sentence.store');
    Route::get('/games', [GamesController::class, 'index'])->name('games.index');
    Route::get('/speed-shuffle', [SpeedShuffleController::class, 'index'])->name('speedshuffle.index');
    Route::get('/sniper', [SniperController::class, 'index'])->name('sniper.index');


});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/users', [AdminDashboardController::class, 'manageUsers'])->name('admin.users');
    Route::get('/users/{user}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/results', [AdminDashboardController::class, 'viewResults'])->name('admin.results');
    Route::get('/achievements', [AdminDashboardController::class, 'manageAchievements'])->name('admin.achievements');
    

    Route::get('/settings', [AdminDashboardController::class, 'gameSettings'])->name('admin.settings');

    Route::post('/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.settings.update');
});

require __DIR__.'/auth.php';
