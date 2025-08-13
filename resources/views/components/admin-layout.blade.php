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
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <div id="admin-sidebar"></div>
        
        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Top Bar --}}
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">Welcome, {{ auth()->user()->username }}</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Admin</span>
                    </div>
                </div>
            </header>
            
            {{-- Content Area --}}
            <main class="flex-1 overflow-y-auto p-6">
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