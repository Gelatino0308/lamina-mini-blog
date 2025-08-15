<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard' }} - {{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/app.jsx'])
</head>
<body class="bg-gray-100">
    @php
        $navItems = [
            ['path' => '/admin/dashboard', 'label' => 'Dashboard', 'icon' => '📊'],
            ['path' => '/admin/users', 'label' => 'Users', 'icon' => '👥'],
            ['path' => '/admin/posts', 'label' => 'Posts', 'icon' => '📝'],
            ['path' => '/admin/comments', 'label' => 'Comments', 'icon' => '💬']
        ];
    @endphp
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <div class="h-screen w-64 bg-black text-white flex flex-col">
            {{-- Header --}}
            <div class="p-6 flex justify-between">
                <div>
                    <h1 class="text-xl font-bold text-orange-300">WeebYaps</h1>
                    <p class="text-sm text-slate-300">Admin Dashboard</p>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('storage/images/WeebYaps-logo.png') }}" 
                        alt="WeebYaps Logo"
                        class="h-12 object-contain">
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 p-4">
                <ul class="space-y-2 flex flex-col gap-4">
                    @foreach($navItems as $item)
                        <li>
                            <a
                                href="{{ $item['path'] }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors 
                                {{ request()->is(ltrim($item['path'], '/')) ? 
                                    'bg-orange-600 text-white' : 
                                    'text-slate-300 hover:bg-gray-500 hover:text-white' }}"
                            >
                                <span class="text-lg">{{ $item['icon'] }}</span>
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Logout --}}
            <div class="p-4 border-t border-slate-700">
                <div data-admin-modal data-modal-type="logout"></div>
            </div>
        </div>
        
        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Top Bar --}}
            <header class="bg-black shadow-sm border-b border-white px-6 py-4">
                <div class="flex items-center justify-between text-white">
                    <h1 class="text-2xl font-semibold">{{ $title ?? 'Dashboard' }}</h1>
                    <div class="flex items-center gap-4">
                        <span class="text-sm">Welcome, {{ auth()->user()->username }}</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Admin</span>
                    </div>
                </div>
            </header>
            
            {{-- Content Area --}}
            <main class="flex-1 overflow-y-auto p-6 bg-gradient-to-b from-black to-[#ff640a]">
                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('delete'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('delete') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>