<x-admin-layout title="Dashboard">
    {{-- Welcome Banner --}}
    <section class="relative w-full h-32 md:h-50 overflow-hidden rounded-xl mb-8 shadow-lg">
        <img src="{{ asset('storage/images/WeebYaps-banner.png') }}" 
            alt="WeebYaps Banner" 
            class="w-full h-full object-cover object-center">
        
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-white">
                <h1 class="text-2xl font-bold mb-2">
                    Welcome to Admin Dashboard
                </h1>
                <p class="text-md text-center">Manage your WeebYaps platform from here</p>
            </div>
        </div>
    </section>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-orange-200 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['users'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-orange-200 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Posts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['posts'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-orange-200 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Comments</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['comments'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-orange-200 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Stars</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['likes'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Posts per Category Chart --}}
    <div class="bg-orange-200 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Posts per Genre</h3>
        
        @if(count($postsPerCategory) > 0)
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @php
                    $categoryColors = [
                        'shonen' => 'bg-red-500',
                        'shojo' => 'bg-pink-500', 
                        'seinen' => 'bg-gray-600',
                        'josei' => 'bg-purple-500',
                        'kodomomuke' => 'bg-yellow-500'
                    ];
                    $categoryLabels = \App\Models\Post::getCategories();
                @endphp
                
                @foreach($postsPerCategory as $category => $count)
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full {{ $categoryColors[$category] ?? 'bg-blue-500' }} mx-auto mb-2 flex items-center justify-center text-white font-bold text-lg">
                            {{ $count }}
                        </div>
                        <p class="text-sm font-medium text-gray-700">{{ $categoryLabels[$category] ?? ucfirst($category) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-8">No posts available yet.</p>
        @endif
    </div>
</x-admin-layout>