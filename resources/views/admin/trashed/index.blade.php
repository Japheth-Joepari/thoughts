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

    @if (!$trashedPosts->isEmpty())
        <table class="table-auto w-full text-left bg-white shadow-md rounded mb-10">
            <thead class="bg-gray-50 text-white">
                <tr class="h-16">
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">Posts Search Results</th>
                    <th class="px-4 py-2 text-left text-xs leading-4 font-medium text-gray-500">Actions</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($trashedPosts as $post)
                    <tr>
                        <td class="border px-4 py-2 text-sm leading-5 font-medium text-gray-900 h-16">{{ $post->name }}
                        </td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('trashed.update', $post) }}" method="post" class="inline">
                                @csrf
                                @method('patch')
                                <button type="submit"
                                    class="text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 px-3">Restore
                                    Post</button>
                            </form>

                            <button
                                class="text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800 px-3 ml-4 trash-post"
                                id="trash-post-{{ $post->id }}">Delete
                                Post</button>

                            <div class="fixed bottom-0 inset-x-0 px-4 pb-4 inset-0 flex items-center justify-center hidden"
                                id="trash-modal-{{ $post->id }}">
                                <div class="fixed inset-0 transition-opacity">
                                    <div id="bd-cont" class="absolute inset-0 bg-gray-500 opacity-75">
                                    </div>
                                </div>
                                <div
                                    class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                    <div>
                                        <form action="{{ route('trashed.destroy', $post) }}" method="post"
                                            id="delete-form-{{ $post->id }}">
                                            @csrf
                                            @method('delete')
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-600">Do you want to permanently delete this post
                                                <p class="text-red-700">Note: this action can't be undone.
                                                    Continue ?</p>
                                                </p>
                                            </div>
                                        </form>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg"
                                                id="yes-button-{{ $post->id }}">Yes</button>
                                            <button
                                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg ml-3"
                                                id="no-button-{{ $post->id }}">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <h1 class="text-center mt-7 text-lg">Trash is Empty</h1>
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
