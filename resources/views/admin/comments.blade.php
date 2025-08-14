<x-admin-layout title="Comments">
    {{-- Page Header --}}
    <h2 class="text-2xl mb-6 font-bold text-orange-200">Total: {{ $comments->total() }} comment/s</h2>

    {{-- Comments Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-200">
                    <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Comment</th>
                        <th class="px-6 py-3">Commented By</th>
                        <th class="px-6 py-3">Post</th>
                        <th class="px-6 py-3">Comment Date</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($comments as $comment)
                        <tr class="hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $comment->id }}</td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="text-sm truncate">{{ Str::limit($comment->comment, 1500) }}</p>
                                    @if(strlen($comment->comment) > 50)
                                        <button 
                                            onclick="this.previousElementSibling.classList.toggle('truncate'); this.textContent = this.textContent === 'Show more' ? 'Show less' : 'Show more'"
                                            class="text-xs text-orange-600 hover:text-orange-800 mt-1"
                                        >
                                            Show more
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium">{{ $comment->user->username }}</div>
                                        <div class="text-sm text-gray-500">{{ $comment->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <a href="{{ route('admin.posts.show', $comment->post) }}" class="text-sm font-medium text-orange-600 hover:text-orange-800 truncate block">
                                        {{ Str::limit($comment->post->title, 35) }}
                                    </a>
                                    <div class="text-sm text-gray-500">by {{ $comment->post->user->username }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $comment->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div data-admin-modal data-modal-type="delete-comment" data-item-id="{{ $comment->id }}"></div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No comments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $comments->links() }}
    </div>
</x-admin-layout>