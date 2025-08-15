<x-admin-layout title="View Post">
    <div class="flex flex-col items-center">
        <a href="{{ url()->previous() }}" class="block mb-6 text-white hover:text-orange-500"> ← Back to Previous Page </a>

        <div class="bg-orange-100 rounded-lg shadow max-w-4xl">
            {{-- Post Content --}}
            <div class="p-6 text-white">
                <x-postCard :post="$post" full />
            </div>

            <div class="p-6">
                <x-comment-section :post="$post"/>
            </div>
        </div>
    </div>
</x-admin-layout>