<x-admin-layout title="Create New Post">
    <div class="max-w-4xl">
        <a href="{{ route('admin.posts') }}" class="block mb-6 text-blue-600 hover:text-blue-800"> ← Back to Posts </a>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Post Title --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('title') border-red-500 @enderror"
                        placeholder="Enter your post title..."
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
                            <option value="{{ $value }}" {{ old('category') == $value ? 'selected' : '' }}>
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
                        placeholder="Write your post content..."
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Post Image --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
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
                        Create Post
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