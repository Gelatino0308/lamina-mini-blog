<x-layout>
    
    <h1 class="title">Latest Posts</h1>

    {{-- Filter dropdown --}}
    <x-categoryFilter 
        :categories="\App\Models\Post::getCategories()" 
        :selected="$selectedCategory" 
    />
    
    {{-- List of posts --}}
    <div class="grid grid-cols-2 gap-6">
        @forelse ($posts as $post)
            <x-postCard :post="$post" />
        @empty
            <div class="col-span-2 text-center py-8">
                <p class="text-gray-300 text-lg">No posts found for the selected genre.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination links --}}
    <div class="mt-8">
        {{ $posts->links() }}
    </div>

</x-layout>