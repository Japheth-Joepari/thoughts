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

    <div class="cont">
        <div class="p-6 sm:p-10 ">
            <div class="flex flex-wrap  md:flex-row justify-between">
                <div class="">
                    <h2 class="text-4xl font-semibold mb-2">Users</h2>
                    <h2 class="text-gray-600 ml-0.5">View all users here ...</h2>
                </div>

                @if (Auth::user()->role == 'admin')
                    <div class="flex flex-wrap items-start justify-end -mb-3">
                        <a href="{{ route('users.create') }}"
                            class="inline-flex px-5 py-3 text-white bg-indigo-600 hover:bg-indigo-700 focus:bg-purple-700 rounded-md  mb-3">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="flex-shrink-0 h-5 w-5 -ml-1 mt-0.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Add new User
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    @if (!$users->isEmpty())
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Add / Remove Role</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Role</th>


                                    @if (Auth::user()->role == 'admin')
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            crud</th>

                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            crud</th>
                                    @endif
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Joined</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Articles</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Following</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Followers</th>

                                </tr>
                            </thead>

                            @foreach ($users as $user)
                                <tbody class="bg-white">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <a href="{{ route('author', $user) }} class="flex-shrink-0 h-10 w-10">
                                                    @if ($user->profile_photo == null)
                                                        <img class="  rounded-full object-cover h-10"
                                                            src=" {{ asset('/images/avartar.png') }} " alt="">
                                                    @else
                                                        <img class="h-10 w-10 rounded-full object-cover"
                                                            src=" {{ asset('/images/' . $user->profile_photo) }} "
                                                            alt="">
                                                    @endif
                                                </a>

                                                <a class="ml-4"
                                                    href="{{ route('author', $user) }}>
                                                    <div class="text-sm
                                                    leading-5 font-medium text-gray-900">
                                                    {{ $user->name }}
                                                    <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>
                                            </div>
                                            </a>
                </div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">
                        @if ($user->role != 'admin')
                            <form action="{{ route('users.changeRole', $user) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Make
                                    Admin</button>
                            </form>
                        @elseif (Auth::user()->id == $user->id || $user->id == 1)
                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                Unauthorized
                            </p>
                        @else
                            <form action="{{ route('users.changeRole', $user) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-white-800">
                                    Remove Admin</button>
                            </form>
                        @endif
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    @if (Auth::user()->id != $user->id)
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500 text-white">LoggedIn</span>
                    @endif
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                    @if ($user->id == '1')
                        Super Admin
                    @else
                        {{ $user->role }}
                    @endif

                </td>

                @if ($user->id == 1 && Auth::id() != $user->id)
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-red-500">
                        <span> Unauthorized</span>
                    </td>
                @else
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        <a href="{{ route('users.edit', $user) }}"> Edit</a>
                    </td>
                @endif



                @if ($user->id == 1)
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-red-500">
                        <span> Not Allowed</span>
                    </td>
                @else
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        <button id="trash-post-{{ $user->id }}" class="trash-post">Delete</button>



                        <div class="fixed bottom-0 inset-x-0 px-4 pb-4 inset-0 flex items-center justify-center hidden"
                            id="trash-modal-{{ $user->id }}">
                            <div class="fixed inset-0 transition-opacity">
                                <div id="bd-cont" class="absolute inset-0 bg-gray-500 opacity-75">
                                </div>
                            </div>
                            <div
                                class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                <div>
                                    <form action="{{ route('users.destroy', $user) }}" method="post"
                                        id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('delete')
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-600">Do you want to delete
                                                this user?</p>
                                        </div>
                                    </form>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg"
                                            id="yes-button-{{ $user->id }}">Yes</button>
                                        <button
                                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg ml-3"
                                            id="no-button-{{ $user->id }}">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                @endif
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-green-500">
                    <span> {{ $user->created_at->diffForHumans() }}</span>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-green-500">
                    <a href="{{ route('author', $user) }}"> {{ $user->post->count() }} Articles</a>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-green-500">
                    <a href="{{ route('author', $user) }}"> {{ $user->following->count() }} Following</a>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-green-500">
                    <a href="{{ route('author', $user) }}"> {{ $user->followers->count() }} Followers</a>
                </td>

                </tr>
                </tbody>
                @endforeach
                </table>
            @else
                <p class="text-gray-600 text-center my-10">No users here. Try adding new users ...</p>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>

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
