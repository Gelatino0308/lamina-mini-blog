<x-layout>

    <a href="{{ route('dashboard') }}" class="block mb-4 text-xs text-white">&larr; Go back to your dashboard</a>

    <div class="card">
        <h2 class="font-bold mb-4">Update your post</h2>

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}" 
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
                        <option value="{{ $value }}" {{ $post->category == $value ? 'selected' : '' }}>
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
                <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ $post->body }}</textarea>
    
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current cover photo if it exists --}}
            @if ($post->image)
                <div class="h-auto rounded-md mb-4 w-1/4 object-cover">
                    <h2 class="mb-3">Current Cover Photo</h2>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="">
                </div>    
            @endif

            {{-- Post Image --}}
            <div class="mb-4">
                <label for="image">Upload Cover Photo: </label>
                <input type="file" name="image" id="image">

                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
    
            {{-- Submit Button --}}
            <button class="btn">Update</button>
        </form>
    </div>
    
</x-layout>