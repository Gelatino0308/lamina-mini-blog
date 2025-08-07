<x-layout>

    {{-- Detailed post --}}
    <x-postCard :post="$post" full/>

    {{-- Comment section --}}
    <div class="card mt-5 bg-orange-300 text-orange-800">
        @auth
            {{-- Comment form --}}
            <form action="{{ route('posts.store-comment', $post) }}" method="post">
                @csrf
                
                {{-- Session Messages --}}
                @if (session('success'))
                    <x-flashMsg msg="{{ session('success') }}" />
                @elseif (session('delete'))
                    <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
                @endif

                <div class="mb-4">
                    <label for="comment">Leave a comment</label>
                    <textarea name="comment" rows="3" class="input @error('comment') ring-red-500 @enderror">{{ old('comment') }}</textarea>
                    
                    @error('comment')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button class="btn">Post Comment</button>
            </form>

        @else
            <p class="text-gray-700 mb-4">
                <a href="{{ route('login') }}" class="text-orange-700">Login</a> to leave a comment.
            </p>
        @endauth
        
        
        <h2 class="font-bold mt-6 mb-4">Comments ({{ $post->comments->count() }})</h2>

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

</x-layout>