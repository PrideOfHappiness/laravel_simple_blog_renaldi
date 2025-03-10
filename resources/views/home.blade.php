<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-10 sm:px-6 lg:px-8">

            {{-- Untuk Guest Users --}}
            @guest
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or
                        <a href="{{ route('register') }}" class="text-blue-500">register</a>.</p>
                    </div>
                </div>
            @endguest

            {{-- Untuk Authenticated Users --}}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="space-y-6 p-6">
                        <h2 class="text-lg font-semibold">All Posts</h2>

                        @foreach ($data as $post)
                            <div class="rounded-md border p-5 shadow">
                                <div class="flex items-center gap-2">
                                    @if ($post->status === 'published')
                                        <span class="flex-none rounded bg-green-100 px-2 py-1 text-green-800">Active</span>
                                    @elseif ($post->status === 'draft')
                                        <span class="flex-none rounded bg-gray-100 px-2 py-1 text-gray-800">Draft</span>
                                    @elseif ($post->status === 'scheduled')
                                        <span class="flex-none rounded bg-yellow-100 px-2 py-1 text-yellow-800">Scheduled</span>
                                    @endif
                                    <h3><a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">{{ $post->title }}</a></h3>
                                </div>
                                <div class="mt-4 flex items-end justify-between">
                                    <div>
                                        <div>Published: {{ $post->published_at ?? '-' }}</div>
                                        <div>Updated: {{ $post->updated_at->format('Y-m-d') }}</div>
                                    </div>
                                    @if ($post->status == 'published')
                                        <div>
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">Detail</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        {{-- Pagination --}}
                        <div class="mt-4">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
