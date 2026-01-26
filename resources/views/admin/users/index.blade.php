@extends('layouts.app')

@section('content')
<div class="p-6 text-white">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manage Users</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white">← Back to Dashboard</a>
    </div>

    {{-- Success Message Alert --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-700 text-gray-200">
                    <th class="p-4">Name</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Role</th>
                    <th class="p-4">Level</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-gray-700 hover:bg-gray-750 transition">
                    <td class="p-4">{{ $user->name }}</td>
                    <td class="p-4 text-gray-300">{{ $user->email }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded text-[10px] font-bold {{ $user->isAdmin() ? 'bg-red-600' : 'bg-blue-600' }}">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>
                    <td class="p-4">{{ $user->level ?? 0 }}</td>
                    <td class="p-4">
                        <div class="flex justify-center space-x-4">
                            {{-- Edit Link --}}
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-400 hover:text-blue-300 transition">
                                Edit
                            </a>

                            {{-- Delete Form --}}
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection