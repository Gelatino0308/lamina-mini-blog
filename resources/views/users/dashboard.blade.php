<x-layout>
    
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $posts->total() }} posts</h1>

    {{-- Create Post Form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        
        {{-- Session Messages --}}
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif
        
        {{-- Create Post Form --}}
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Category --}}
            <div class="mb-4">
                <label for="category">Post Category</label>
                <select name="category" id="category" class="input @error('category') ring-red-500 @enderror">
                    <option value="">Select the anime category</option>
                    @foreach (\App\Models\Post::getCategories() as $value => $label)
                        <option value="{{ $value }}" {{ old('category' == $value ? 'selected' : '' ) }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ old('body') }}</textarea>

                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Image --}}
            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image">

                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="btn">Create</button>
        </form>
    </div>

    {{-- User Posts --}}
    <h2 class="font-bold mb-4">Your Latest Posts</h2>

    <div x-data="{ selectedCategory: 'all' }">
        {{-- Filter dropdown --}}
        <x-categoryFilter :categories="\App\Models\Post::getCategories()" />
        
        {{-- User's posts --}}
        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div x-show="selectedCategory === 'all' || selectedCategory === '{{ $post->category }}'">
                    <x-postCard :post="$post">
                        {{-- Update post --}}
                        <a href="{{ route('posts.edit', $post) }}" class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>
                        {{-- Delete post --}}
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                        </form>
                    </x-postCard>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        {{ $posts->links() }}
    </div>
</x-layout>