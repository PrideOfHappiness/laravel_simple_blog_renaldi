<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-2xl font-semibold">{{ $post->title }}</h3>
                <p class="text-gray-500 text-sm mt-1">By: {{ $post->getUser->name }}</p>

                <div class="mt-4">
                    <span class="px-3 py-1 rounded-md {{ $post->status === 'published' ? 'bg-green-500 text-white' : ($post->status === 'draft' ? 'bg-gray-500 text-white' : 'bg-yellow-500 text-white') }}">
                        {{ ucfirst($post->status) }}
                    </span>
                </div>

                <div class="mt-4">
                    <p class="text-lg">{{ $post->description }}</p>
                </div>

                <div class="mt-4 text-gray-600 text-sm">
                    <p><strong>Published At:</strong> {{ $post->published_at ?? 'Not Set' }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('posts.index') }}" class="text-blue-500">Back to Posts</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
