<x-layout>

    <x-postCard :post="$post" full/>

    <div class="card">
        <form action="" method="post">
            @csrf
            
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
        
        <h2 class="font-bold mt-4">Comments (0)</h2>
    </div>

</x-layout>