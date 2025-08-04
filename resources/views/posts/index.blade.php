<x-layout>
    
    <h1 class="title">Latest Posts</h1>

    <div x-data="{ selectedCategory: 'all' }">
        {{-- Filter dropdown --}}
        <x-categoryFilter :categories="\App\Models\Post::getCategories()" />
        
        {{-- List of posts --}}
        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div x-show="selectedCategory === 'all' || selectedCategory === '{{ $post->category }}'">
                    <x-postCard :post="$post" />
                </div>
            @endforeach
        </div>
    </div>

    {{-- Pagination links --}}
    <div>
        {{ $posts->links() }}
    </div>

</x-layout>