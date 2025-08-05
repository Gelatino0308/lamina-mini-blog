@props(['post', 'full' => false])

@php
    $categoryColors = [
        'shonen' => 'bg-red-600',
        'shojo' => 'bg-pink-600', 
        'seinen' => 'bg-gray-700',
        'josei' => 'bg-purple-600',
        'kodomomuke' => 'bg-yellow-500'
    ];
    $bgColor = $categoryColors[$post->category] ?? 'bg-blue-800';
    
    $isLiked = Auth::check() ? $post->isLikedBy(Auth::user()) : false;
@endphp

<div class="card h-full">
    <div class="flex gap-6">

        {{-- Cover photo --}}
        <div class="h-auto w-1/5 rounded-md overflow-hidden self-start">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="">
            @else
                <img class="object-cover object-center rounded-md" src="{{ asset('storage/posts_images/default.jpg') }}" alt="">
            @endif
        </div>

        <div class="w-4/5">
            {{-- Title --}}
            <h2 class="font-bold text-xl">{{ $post->title }}</h2>

            <div class="flex justify-between text-xs mt-2 mb-5">
                {{-- Author and Date --}}
                <div class="text-sm font-light">
                    <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
                    <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
                </div>
                {{-- Category --}}
                <span class="text-xs font-bold text-white {{ $bgColor }} px-3 py-1 rounded-xl">{{ $post->category }}</span>
            </div>

            {{-- Body --}}
            @if ($full)
                <div class="text-sm">
                    <span>{{ $post->body }}</span>
                </div>
            @else
                <span class="block">{{ Str::words($post->body, 15) }}</span>
            @endif
            
            <div class="flex justify-between mt-2">
                @if (!$full) 
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-500 mr-3">Read more &rarr;</a>
                @endif
                
                {{-- Like Button --}}
                <div 
                    x-data="{ 
                        likes: {{ $post->likes }}, 
                        isLiked: {{ $isLiked ? 'true' : 'false' }},
                        isLoading: false,
                        isAuthenticated: {{ Auth::check() ? 'true' : 'false' }},
                        async toggleLike() {
                            if (!this.isAuthenticated) {
                                alert('Please login to like posts');
                                return;
                            }
                            
                            if (this.isLoading) return;
                            this.isLoading = true;
                            
                            try {
                                const response = await fetch('{{ route('posts.toggle-like', $post) }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                    }" 
                    class="text-lg select-none flex items-center gap-1"
                    :class="isAuthenticated ? 'cursor-pointer' : 'cursor-not-allowed'"
                    @click="toggleLike()"
                >
                    <span 
                        class="transition-colors duration-200"
                        :class="isLiked ? 'text-yellow-500' : 'text-gray-400'"
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

    {{-- Placeholder for extra elements used in user dashboard --}}
    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>
</div>