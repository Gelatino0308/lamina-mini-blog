@props(['post', 'full' => false])

@php
    $categoryColors = [
        'shonen' => 'bg-red-600',
        'shojo' => 'bg-pink-600', 
        'seinen' => 'bg-gray-700',
        'josei' => 'bg-purple-600',
        'kodomomuke' => 'bg-yellow-500'
    ];
@endphp

<div class="card h-full">
    <div class="flex gap-6">

        {{-- Cover photo --}}
        <div class="h-auto w-1/5 rounded-md overflow-hidden self-start">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="">
            @else
                <img class="object-cover object-center rounded-md" src="{{ asset('storage/posts_images/default.png') }}" alt="">
            @endif
        </div>

        <div class="w-4/5">
            {{-- Title --}}
            <h2 class="font-bold text-xl">{{ $post->title }}</h2>

            <div class="flex justify-between items-start text-xs mt-2 mb-5">
                {{-- Author and Date --}}
                <div class="text-sm font-light flex flex-col">
                    <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
                    @if (Auth::check() && Auth::user()->role != 'admin')    
                        <a href="{{ route('posts.user', $post->user) }}" class="text-black font-medium">{{ $post->user->username }}</a>
                    @else
                        <span class="text-black font-medium">{{ $post->user->username }}</span>
                    @endif
                </div>
                {{-- Category --}}
                <span class="text-xs font-bold text-white shadow-sm shadow-orange-900 {{ $categoryColors[$post->category] ?? 'bg-blue-800' }} px-3 py-1 rounded-xl">{{ $post->category }}</span>
            </div>

            {{-- Body --}}
            <p class="text-justify">
                @if ($full)
                    {{ $post->body }}
                @else
                    {{ Str::words($post->body, 15) }}
                @endif
            </p>
            
            <div class="flex justify-between mt-2">
                @if (!$full) 
                    <a href="{{ route('posts.show', $post) }}" class="text-black mr-3">Read more &rarr;</a>
                @endif
                
                {{-- Like Button --}}
                <div 
                    x-data="likeButton({{ $post->likes }}, 
                        @json(Auth::check() ? $post->isLikedBy(Auth::user()) : false), 
                        @json(Auth::check()), 
                        '{{ route('posts.toggle-like', $post) }}', 
                        '{{ csrf_token() }}')"
                    class="text-lg select-none flex items-center gap-1"
                    :class="isAuthenticated ? 'cursor-pointer' : 'cursor-not-allowed'"
                    @click="toggleLike()"
                >
                    <span 
                        :class="isLiked ? 'text-white' : 'text-orange-800'"
                        class="transition-colors duration-200"
                        :style="isLoading ? 'opacity: 0.5' : ''"
                    >
                        ★
                    </span>
                    <span 
                        class="font-bold"
                        x-text="likes"
                    ></span>
                </div>
            </div>
        </div>
    </div>

    @if(request()->routeIs('dashboard'))
        {{-- Placeholder for extra elements used in user dashboard --}}
        <div class="flex items-center justify-end gap-4 mt-6">
            {{ $slot }}
        </div>
    @endif
    
</div>

{{-- Moved Alpine js object to script --}}
<script>
    function likeButton(initialLikes, initialIsLiked, isAuthenticated, toggleUrl, csrfToken) {
        return {
            likes: initialLikes,
            isLiked: initialIsLiked,
            isLoading: false,
            isAuthenticated: isAuthenticated,
            async toggleLike() {
                if (!this.isAuthenticated) {
                    alert('Please login to like posts');
                    return;
                }
                
                if (this.isLoading) return;
                this.isLoading = true;
                
                try {
                    const response = await fetch(toggleUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    
                    if (response.status === 401) {
                        alert('Please login to like posts');
                        return;
                    }
                    
                    const data = await response.json();
                    this.likes = data.likes;
                    this.isLiked = data.isLiked;
                } catch (error) {
                    console.error('Error toggling like:', error);
                    alert('Something went wrong. Please try again.');
                } finally {
                    this.isLoading = false;
                }
            }
        }
    }
</script>