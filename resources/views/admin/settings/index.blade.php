@extends('layouts.app')

@section('content')
<div class="p-6 text-white max-w-2xl">
    <h1 class="text-3xl font-bold mb-6">System Settings</h1>

<form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 bg-gray-800 p-6 rounded-lg">        @csrf
        <div>
            <label class="block mb-2 font-medium">Default Test Duration (Seconds)</label>
            <input type="number" name="duration" value="60" class="w-full bg-gray-900 border-gray-700 rounded text-white">
        </div>

        <div>
            <label class="block mb-2 font-medium">Difficulty Level</label>
            <select name="difficulty" class="w-full bg-gray-900 border-gray-700 rounded text-white">
                <option value="easy">Easy (Common Words)</option>
                <option value="medium" selected>Medium (Sentences)</option>
                <option value="hard">Hard (Code Snippets)</option>
            </select>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="maintenance" name="maintenance" class="rounded text-blue-600">
            <label for="maintenance">Enable Maintenance Mode</label>
        </div>

        <button type="submit" class="bg-blue-600 w-full py-3 rounded font-bold hover:bg-blue-700">
            Save Configuration
        </button>
    </form>
</div>
@endsection