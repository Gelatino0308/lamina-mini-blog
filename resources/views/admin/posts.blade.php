<x-admin-layout title="Posts">
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-orange-200">Total: {{ $posts->total() }} post/s</h2>
        <a href="{{ route('admin.posts.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
            Create New Post
        </a>
    </div>

    {{-- Posts Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-200">
                    <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Cover Image</th>
                        <th class="px-6 py-3">Post Title</th>
                        <th class="px-6 py-3">Genre</th>
                        <th class="px-6 py-3">Date Created</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-orange-100 divide-y divide-gray-300">
                    @forelse($posts as $post)
                        <tr class="hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $post->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-16 h-12 rounded overflow-hidden">
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post cover" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <img class="object-cover object-center rounded-md" src="{{ asset('storage/posts_images/default.png') }}" alt="">
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                                <div class="text-sm text-gray-500">by {{ $post->user->username }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div data-category-dropdown data-post-id="{{ $post->id }}" data-current-category="{{ $post->category }}"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $post->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.posts.show', $post) }}" class="bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600 transition-colors">
                                        View
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="bg-green-500 text-white px-3 py-1 text-sm rounded hover:bg-green-600 transition-colors">
                                        Edit
                                    </a>
                                    <div data-admin-modal data-modal-type="delete-post" data-item-id="{{ $post->id }}"></div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No posts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $posts->links() }}
    </div>
</x-admin-layout>