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
                <h2 class="text-4xl font-semibold mb-2">Posts</h2>
                <h2 class="text-gray-600 ml-0.5">View all posts here ...</h2>
            </div>

            <div class="flex flex-wrap items-start justify-end -mb-3">
                <a href="{{ route('posts.create') }}"
                    class="inline-flex px-5 py-3 text-white bg-indigo-600 hover:bg-indigo-700 focus:bg-purple-700 rounded-md  mb-3">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="flex-shrink-0 h-5 w-5 -ml-1 mt-0.5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Create new post
                </a>
            </div>
        </div>
    </div>

    <!-- Loop through the posts and display each post in a card -->
    @if ($posts != '')
        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">

                @foreach ($posts as $post)
                    <!-- Column -->
                    <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg  shadow-lg">

                            <a href="{{ route('viewArticle', $post) }}">
                                <img alt="Placeholder" class="block h-auto w-full object-cover" src="{{ $post->image }}">
                            </a>

                            <header class="flex-col items-center justify-between leading-tight p-2 md:p-4">
                                <h1 class="text-lg">
                                    <a class="no-underline hover:underline text-black"
                                        href="{{ route('viewArticle', $post) }}">
                                        <h5
                                            class="mb-2 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {!! Str::limit($post->name, 70) !!}</h5>
                                    </a>
                                </h1>

                                <p class="text-grey-darker text-sm">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </header>

                            <footer class="flex-col  items-center justify-between leading-none p-2 md:p-4">
                                <a href="{{ route('author', $post->user) }}"
                                    class="flex items-center no-underline hover:underline text-black" href="#">
                                    <img alt="Placeholder" class="block rounded-full h-4 w-4 object-cover"
                                        src="{{ $post->user->profile_photo }}">
                                    <div>

                                        <p class="ml-2 text-sm">
                                            {{ $post->user->name }}

                                        </p>
                                    </div>
                                </a>
                                <div class="flex-row justify-start w-full">
                                    <a href="{{ route('categoryPost', $post->category) }}"
                                        class="px-2 text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800">{{ $post->category->name }}</a>
                                    @foreach ($post->tags as $postTag)
                                        <a href="{{ route('tagPost', $postTag) }}"
                                            class="px-2  text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $postTag->name }}</a>
                                    @endforeach
                                </div>


                                <div class="flex justify-start">
                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="px-4 py-2 text-xs font-medium bg-blue-800 text-white hover:text-gray-700"><svg
                                            aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            class="flex-shrink-0 h-3 w-5 -ml-1 mt-0.5 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg></a>

                                    <button type="submit" id="trash-post-{{ $post->id }}"
                                        class="px-4 py-2 text-xs font-medium bg-red-500 text-white hover:text-gray-700 trash-post">
                                        <i class="fa fa-trash"></i></button>

                                    <form method="POST" action="{{ route('posts.toggleFeatured', $post) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-4 py-2 text-xs bg-blue-300 font-medium text-gray hover:text-gray-700 trash-post"
                                            class="btn btn-{{ $post->featured ? 'warning' : 'success' }}">
                                            {{ $post->featured ? 'Featured' : 'Feature' }}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('posts.togglePicked', $post) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-4 py-2 text-xs font-medium bg-yellow-400 text-gray hover:text-gray-700 trash-post">
                                            {{ $post->is_editor_pick ? 'Picked' : 'NotPicked' }}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('posts.increasePopularity', $post) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 text-xs font-medium bg-green-800 text-white hover:text-gray-700 trash-post">
                                            + view
                                        </button>
                                    </form>

                                </div>

                                <div class="fixed bottom-0 inset-x-0 px-4 pb-4 inset-0 flex items-center justify-center hidden"
                                    id="trash-modal-{{ $post->id }}">
                                    <div class="fixed inset-0 transition-opacity">
                                        <div id="bd-cont" class="absolute inset-0 bg-gray-500 opacity-75">
                                        </div>
                                    </div>
                                    <div
                                        class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                        <div>
                                            <form action="{{ route('posts.destroy', $post) }}" method="post"
                                                id="delete-form-{{ $post->id }}">
                                                @csrf
                                                @method('delete')
                                                <div class="mb-4">
                                                    <p class="text-sm text-gray-600">Are you sure you want to move this post
                                                        to trash ?</p>
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
                            </footer>

                        </article>
                        <!-- END Article -->

                    </div>
                    <!-- END Column -->
                @endforeach

            </div>
        </div>
    @else
        <p class="text-gray-600 text-center my-10">No posts found. Try creating some ...</p>
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
