<x-admin-layout title="Edit Post">
    <div class="max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.posts') }}" class="text-blue-600 hover:text-blue-800">
                ← Back to Posts
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Edit Post</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Post Title --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ $post->title }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Post Category --}}
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select 
                        name="category" 
                        id="category" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('category') border-red-500 @enderror"
                    >
                        <option value="">Select anime/manga category</option>
                        @foreach (\App\Models\Post::getCategories() as $value => $label)
                            <option value="{{ $value }}" {{ $post->category == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Post Body --}}
                <div class="mb-6">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea 
                        name="body" 
                        rows="10" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('body') border-red-500 @enderror"
                    >{{ $post->body }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Current Image --}}
                @if ($post->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Cover Image</label>
                        <div class="w-32 h-24 rounded-lg overflow-hidden border border-gray-300">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Current cover" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                {{-- Post Image --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $post->image ? 'Change Cover Image' : 'Upload Cover Image' }}
                    </label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image"
                        accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                    >
                    <p class="mt-1 text-sm text-gray-500">Supported formats: WEBP, PNG, JPG (Max: 3MB)</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Buttons --}}
                <div class="flex items-center gap-4">
                    <button 
                        type="submit" 
                        class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-medium transition-colors"
                    >
                        Update Post
                    </button>
                    <a 
                        href="{{ route('admin.posts') }}" 
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md font-medium transition-colors"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>