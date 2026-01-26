<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Result;
use App\Models\Achievement;
use Illuminate\Http\Request; 


class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::latest()->paginate(10); 
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function updateUser(Request $request, User $user)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:user,admin',
    ]);

    $user->update($data);

    return redirect()->route('admin.users')->with('success', 'User updated successfully');
}

public function deleteUser(User $user)
{
    if (auth()->id() === $user->id) {
        return back()->with('error', 'You cannot delete your own account.');
    }

    $user->delete();
    return back()->with('success', 'User deleted successfully');
}

    public function viewResults()
    {
        $results = Result::with('user')->latest()->get();
        return view('admin.results.index', compact('results'));
    }

    public function manageAchievements()
    {
        $achievements = Achievement::all();
        return view('admin.achievements.index', compact('achievements'));
    }

    public function gameSettings()
    {
        return view('admin.settings.index');
    }

    public function updateSettings(Request $request)
{

$request->validate([
        'duration' => 'required|integer',
        'difficulty' => 'required|string',
    ]);

    return back()->with('success', 'Settings updated successfully!');
}
}
