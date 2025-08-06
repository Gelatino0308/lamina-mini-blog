<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-white bg-gradient-to-r from from-black to-orange-500">
    <header class="bg-black shadow-lg">
        <nav class="h-20 w-full px-4 grid grid-cols-3 items-center max-w-screen-lg mx-auto">
            {{-- Left section --}}
            <div class="flex justify-start">
                <a href="{{ route('posts.index') }}" class="nav-link">Home</a>
            </div>

            {{-- Center section (Logo) --}}
            <div class="flex justify-center">
                <img src="{{ asset('storage/images/WeebYaps-logo.png') }}" 
                    alt="WeebYaps Logo"
                    class="h-12 object-contain">
            </div>

            {{-- Right section --}}
            <div class="flex justify-end">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        {{-- Dropdown menu button --}}
                        <button @click="open = !open" type="button" class="round-btn">
                            <img src="{{ asset('storage/images/user.png') }}" alt="">
                        </button>

                        {{-- Dropdown menu --}}
                        <div x-show="open" 
                            @click.outside="open = false" 
                            class="bg-white shadow-lg absolute top-12 right-0 rounded-lg overflow-hidden z-10 text-lg text-slate-900 min-w-30"
                        >
                            <p class="username">{{ auth()->user()->username }}</p>
                            <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest     
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </div>
                @endguest
            </div>
        </nav>
    </header>

    <main class="py-8 px-4 mx-auto max-w-screen-lg relative">
        @if(request()->routeIs('posts.index'))
            {{-- Hero Banner Section --}}
            <section class="relative w-full h-32 md:h-60 overflow-hidden rounded-xl mb-8 shadow-xl">
                <img src="{{ asset('storage/images/anime-bg.jpg') }}" 
                    alt="WeebYaps Banner" 
                    class="w-full h-full object-cover object-center">
                
                <div class="absolute inset-0 bg-black/50"></div>
                
                <div class="absolute inset-0 flex items-center justify-start pl-10">
                    <div class="text-white">
                        <h1 class="text-2xl md:text-4xl font-bold drop-shadow-lg">
                            Welcome to <span class="text-orange-300">WeebYaps</span>
                        </h1>
                        <p class="text-sm md:text-xl drop-shadow-md">Your anime and manga discussion hub</p>
                    </div>
                </div>
            </section>
        @endif

        {{ $slot }}
    </main>
</body>
</html>