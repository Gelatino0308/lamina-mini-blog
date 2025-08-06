<x-layout>
    <h1 class="title">{{ $user->username }}'s Posts &#9830; {{ $posts->total() }} {{ \App\Models\Post::getCategories()[$selectedCategory] ?? 'Total' }} Post</h1>

    {{-- Filter dropdown --}}
    <x-categoryFilter 
        :categories="\App\Models\Post::getCategories()" 
        :selected="$selectedCategory" 
    />

    {{-- User's posts --}}
    <div class="grid grid-cols-2 gap-6">
        @forelse ($posts as $post)
            <x-postCard :post="$post" />
        @empty
            <div class="col-span-2 text-center py-8">
                <p class="text-gray-500 text-lg">No posts found for the selected genre.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</x-layout>