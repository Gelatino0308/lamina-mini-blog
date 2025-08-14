<x-admin-layout title="Create New Post">
    <div class="flex flex-col items-center">
        <a href="{{ route('admin.posts') }}" class="mb-6 text-white hover:text-orange-500"> ← Back to Posts </a>

        <div class="bg-orange-100 rounded-lg shadow p-6 max-w-4xl w-full">
            <div 
                data-admin-post-form
                data-form-data="{}"
                data-errors="{{ json_encode($errors->getMessages()) }}"
                data-categories="{{ json_encode(\App\Models\Post::getCategories()) }}"
                data-submit-url="{{ route('admin.posts.store') }}"
                data-method="POST"
                data-submit-text="Create Post"
                data-cancel-url="{{ route('admin.posts') }}"
            ></div>
        </div>
    </div>
</x-admin-layout>