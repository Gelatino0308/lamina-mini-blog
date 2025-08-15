@props(['post'])

<h2 class="font-bold mb-4">Comments ({{ $post->comments->count() }})</h2>

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