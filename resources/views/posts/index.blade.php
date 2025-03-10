<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Title</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Published At</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $data)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $data->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($data->status) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('posts.show', $data->id) }}" class="text-blue-500">View</a> |
                                <a href="{{ route('posts.edit', $data->id) }}" class="text-green-500">Edit</a> |
                                <form action="{{ route('posts.destroy', $data->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
