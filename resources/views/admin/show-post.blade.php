<x-admin-layout title="View Post">
    <div class="max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.posts') }}" class="text-blue-600 hover:text-blue-800">
                ← Back to Posts
            </a>
            <h2 class="text-2xl font-bold text-gray-900">View Post</h2>
        </div>

        <div class="bg-white rounded-lg shadow">
            {{-- Post Content --}}
            <div class="p-6 text-white">
                <x-postCard :post="$post" full />
            </div>

            {{-- Post's comments --}}
            <div class="space-y-4">
                @forelse ($post->comments as $comment)
                    <div class="bg-orange-400 p-4 rounded-lg border-l-4 border-orange-900">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">{{ $comment->user->username }}</span>
                                <span class="text-xs text-orange-100">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-black">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p class="text-[#ff640a] text-center py-8 text-lg">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>