<!DOCTYPE html>
<html lang="en" class="scroll-smooth" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Gamified Typing') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/typing.js'])
    @vite(['resources/css/app.css', 'resources/js/sniper.js'])



    <style>
        /* Glitch effect for logo */
        .glitch {
            position: relative;
            color: #0ff;
            font-weight: 900;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .glitch::before,
        .glitch::after {
            content: attr(data-text);
            position: absolute;
            left: 0; top: 0;
            width: 100%; height: 100%;
            opacity: 0.8;
            clip: rect(0, 900px, 0, 0);
        }
        .glitch::before {
            animation: glitchTop 1s infinite linear alternate-reverse;
            color: #0ff;
            z-index: -1;
        }
        .glitch::after {
            animation: glitchBottom 1s infinite linear alternate-reverse;
            color: #f0f;
            z-index: -2;
        }
        @keyframes glitchTop {
            0% {
                clip: rect(0, 900px, 44px, 0);
                transform: translate(-3px, -3px);
            }
            50% {
                clip: rect(2px, 900px, 40px, 0);
                transform: translate(3px, 3px);
            }
            100% {
                clip: rect(0, 900px, 44px, 0);
                transform: translate(-3px, -3px);
            }
        }
        @keyframes glitchBottom {
            0% {
                clip: rect(44px, 900px, 88px, 0);
                transform: translate(3px, 3px);
            }
            50% {
                clip: rect(50px, 900px, 82px, 0);
                transform: translate(-3px, -3px);
            }
            100% {
                clip: rect(44px, 900px, 88px, 0);
                transform: translate(3px, 3px);
            }
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col font-mono antialiased">

    <nav class="bg-gray-800 px-8 py-4 flex justify-between items-center shadow-lg sticky top-0 z-50 select-none">
        <a href="{{ url('/') }}" class="glitch" data-text="Gamified Typing">Gamified Typing</a>

        <div class="space-x-6 text-sm font-light text-gray-300 flex items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-cyan-400 transition duration-300">Dashboard</a>
                <a href="{{ route('typing.index') }}" class="hover:text-cyan-400 transition duration-300">Typing Test</a>
                <a href="{{ route('leaderboard.index') }}" class="hover:text-cyan-400 transition duration-300">Leaderboard</a>
                <a href="{{ route('achievements.index') }}" class="hover:text-cyan-400 transition duration-300">Achievements</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-red-500 transition duration-300">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-cyan-400 transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="hover:text-cyan-400 transition duration-300">Register</a>
            @endauth
        </div>
    </nav>

    @if (session('success'))
        <div class="bg-green-600 text-white text-center py-3 font-semibold select-text">
            {{ session('success') }}
        </div>
    @endif

    <main class="flex-1 p-10 max-w-5xl mx-auto w-full">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-center py-4 text-gray-400 text-xs font-mono select-none border-t border-gray-700">
        &copy; {{ date('Y') }} Gamified Typing. All rights reserved.
    </footer>

</body>
</html>
