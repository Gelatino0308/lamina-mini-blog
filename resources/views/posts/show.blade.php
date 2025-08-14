<x-layout title="Post Details">

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
    
        
        <div class="mt-6">
            <x-comment-section :post="$post"/>
        </div>
    </div>

</x-layout>