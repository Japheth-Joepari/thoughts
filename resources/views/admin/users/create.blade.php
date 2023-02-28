@extends('layouts.dashboard')
@section('content')
    <div class=" w-3/4 mx-auto py-10">

        <form class="bg-white shadow-2xl rounded px-8 pt-6 pb-8 mb-4 " method="post" enctype="multipart/form-data"
            action="{{ request()->routeIs('users.create') ? route('users.store') : route('users.update', $user) }}">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="name">
                    Username
                </label>
                <input
                    class="shadow appearance-none border-gray-300 rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                    id="name" type="text" name="name"
                    value="{{ request()->routeIs('users.create') ? old('name') : old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="email">
                    Email
                </label>
                <input
                    class="shadow appearance-none border-gray-300 rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                    id="email" type="text" name="email"
                    value="{{ request()->routeIs('users.create') ? old('email') : old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="password">
                    Password
                </label>
                <input
                    class="shadow appearance-none border-gray-300 rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                    id="password" type="password" name="password" value="">
                @error('password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="confirm_password">
                    confirm_password
                </label>

                <input
                    class="shadow appearance-none border-gray-300 rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                    id="confirm_password" type="password" name="confirm_password" value=""
                    autocomplete="new-password">
                @error('confirm_password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            @if (request()->routeIs('users.edit'))
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="profile_photo">
                        profile_photo
                    </label>
                    <input
                        class="shadow appearance-none border-gray-300 rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                        id="profile_photo" type="file" name="profile_photo" value="">
                    @error('profile_photo')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="flex items-center justify-between">
                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    {{ request()->routeIs('users.create') ? '+ Create' : '+ Update' }}
                </button>
            </div>
        </form>
    </div>
@endsection
