<x-admin-layout title="Edit Post">
    <div class="flex flex-col items-center">
        <a href="{{ route('admin.posts') }}" class="block mb-6 text-white hover:text-orange-500"> ← Back to Posts </a>

        <div class="bg-orange-100 rounded-lg shadow p-6 max-w-4xl w-full">
            {{-- Current Image Display --}}
            @if ($post->image)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Cover Image</label>
                    <div class="w-32 h-auto rounded-lg overflow-hidden border border-gray-300">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current cover" class="w-full h-full object-cover">
                    </div>
                </div>
            @endif

            <div 
                data-admin-post-form
                data-form-data="{{ json_encode([
                    'title' => $post->title,
                    'category' => $post->category,
                    'body' => $post->body
                ]) }}"
                data-errors="{{ json_encode($errors->getMessages()) }}"
                data-categories="{{ json_encode(\App\Models\Post::getCategories()) }}"
                data-submit-url="{{ route('admin.posts.update', $post) }}"
                data-method="PUT"
                data-submit-text="Update Post"
                data-cancel-url="{{ route('admin.posts') }}"
            ></div>
        </div>
    </div>
</x-admin-layout>