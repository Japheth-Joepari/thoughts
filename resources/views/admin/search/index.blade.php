@extends('layouts.dashboard')
@section('content')
    <h3 class="text-center m-4 text-lg">Search results for "{{ $searchQuery }}"</h3>
    @if (!$categories->isEmpty() || !$tags->isEmpty() || !$posts->isEmpty() || !$users->isEmpty())
        <table class="table-auto w-full text-left bg-white shadow-md rounded mb-10">
            <thead class="bg-gray-50 text-white">
                <tr class="h-16">
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">Search Results</th>
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900 h-16">{{ $category->name }}
                        </td>
                        <td class="border px-4 py-2">
                            <a class="text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 px-3"
                                href="{{ route('categories.edit', $category) }}">Edit</a>
                            <form class="inline" method="post"
                                action="{{ request()->routeIs('categories.create') ? route('categories.store') : route('categories.update', $category) }}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800 px-3 ml-4">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @foreach ($tags as $tag)
                    <tr>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900 h-16">{{ $tag->name }}
                        </td>
                        <td class="border px-4 py-2">
                            <a class="text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 px-3"
                                href="{{ route('tags.edit', $tag) }}">Edit</a>
                            <form class="inline" method="post"
                                action="{{ request()->routeIs('tags.create') ? route('tags.store') : route('tags.update', $tag) }}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800 px-3 ml-4">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @foreach ($posts as $post)
                    <tr>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900 h-16">{{ $post->name }}
                        </td>
                        <td class="border px-4 py-2">
                            <a class="text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 px-3"
                                href="{{ route('posts.edit', $post) }}">Edit</a>
                            <form class="inline" method="post"
                                action="{{ request()->routeIs('posts.create') ? route('posts.store') : route('posts.update', $post) }}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800 px-3 ml-4">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900 h-16">{{ $user->name }}
                        </td>
                        <td class="border px-4 py-2">
                            <a class="text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 px-3"
                                href="{{ route('users.edit', $user) }}">Edit</a>
                            <form class="inline" method="user"
                                action="{{ request()->routeIs('users.create') ? route('users.store') : route('users.update', $user) }}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800 px-3 ml-4">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600 text-center my-10">No search found</p>
    @endif
@endsection
