<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('posts.update', $post->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ $post->title }}" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea id="content" name="content" class="mt-1 block w-full" rows="6">{{ $post->description }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="published_at" :value="__('Publish Date')" />
                        <x-text-input id="published_at" name="published_at" type="date" class="mt-1 block w-full" value="{{ $post->published_at }}" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update Post') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
