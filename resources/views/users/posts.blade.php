<x-layout>
    <h1 class="title">{{ $user->username }}'s Posts &#9830; {{ $posts->total() }}</h1>

    <div x-data="{ selectedCategory: 'all' }">
        {{-- Filter dropdown --}}
        <x-categoryFilter :categories="\App\Models\Post::getCategories()" />

        {{-- User's posts --}}
        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div x-show="selectedCategory === 'all' || selectedCategory === '{{ $post->category }}'">
                    <x-postCard :post="$post" />
                </div>
            @endforeach
        </div>

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>