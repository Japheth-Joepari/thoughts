@extends('layouts.dashboard')
@section('content')

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-geen-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-2 bg-red-500 text-white rounded-md">
            {{ session('error') }}
        </div>
    @endif
    <div class="p-6 sm:p-10 ">
        <div class="flex flex-wrap  md:flex-row justify-between">
            <div class="">
                <h2 class="text-4xl font-semibold mb-2">Tags</h2>
                <h2 class="text-gray-600 ml-0.5">View all tags here ...</h2>
            </div>

            <div class="flex flex-wrap items-start justify-end -mb-3">
                <a href="{{ route('tags.create') }}"
                    class="inline-flex px-5 py-3 text-white bg-indigo-600 hover:bg-indigo-700 focus:bg-purple-700 rounded-md  mb-3">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="flex-shrink-0 h-5 w-5 -ml-1 mt-0.5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Create new tag
                </a>
            </div>
        </div>
    </div>

    @if ($tags != '')
        <table class="table-auto w-full text-left bg-white shadow-md rounded mb-10">
            <thead class="bg-gray-50 text-white">
                <tr class="h-16">
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">Name</th>
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">Actions</th>
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">created by</th>
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900 h-16"><a
                                href="{{ route('tagPost', $tag) }}">{{ $tag->name }}</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a class="text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 px-3"
                                href="{{ route('tags.edit', $tag) }}">Edit</a>

                            <button type="submit" id="trash-post-{{ $tag->id }}"
                                class="trash-post text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800 px-3 ml-4">Delete</button>
                            <div class="fixed bottom-0 inset-x-0 px-4 pb-4 inset-0 flex items-center justify-center hidden"
                                id="trash-modal-{{ $tag->id }}">
                                <div class="fixed inset-0 transition-opacity">
                                    <div id="bd-cont" class="absolute inset-0 bg-gray-500 opacity-75">
                                    </div>
                                </div>
                                <div
                                    class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                    <div>
                                        <form action="{{ route('tags.destroy', $tag) }}" method="post"
                                            id="delete-form-{{ $tag->id }}">
                                            @csrf
                                            @method('delete')
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-600">Are you sure you want to move this tag to
                                                    trash ?</p>
                                            </div>
                                        </form>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg"
                                                id="yes-button-{{ $tag->id }}">Yes</button>
                                            <button
                                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg ml-3"
                                                id="no-button-{{ $tag->id }}">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900">{{ $tag->user->name }}
                        </td>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900">{{ $tag->posts->count() }}
                            posts</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600 text-center my-10">No tags found. Try creating some ...</p>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var trashPostButtons = document.getElementsByClassName("trash-post");
            for (var i = 0; i < trashPostButtons.length; i++) {
                trashPostButtons[i].addEventListener("click", function() {
                    var userId = this.id.split("-")[2];
                    var trashModal = document.getElementById("trash-modal-" + userId);
                    trashModal.classList.remove("hidden");

                    var yesButton = document.getElementById("yes-button-" + userId);
                    yesButton.addEventListener("click", function() {
                        var deleteForm = document.getElementById("delete-form-" + userId);
                        deleteForm.submit();
                    });

                    var noButton = document.getElementById("no-button-" + userId);
                    noButton.addEventListener("click", function() {
                        trashModal.classList.add("hidden");
                    });
                });
            }
        });
    </script>
@endsection
