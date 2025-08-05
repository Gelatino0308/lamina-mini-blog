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

            <div class="flex justify-between text-xs mb-4">
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
                <div class="text-sm">
                    <span>{{ Str::words($post->body, 15) }}</span>
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-500 ml-2">Read more &rarr;</a>
                </div>
            @endif
        </div>
    </div>

    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>
</div>