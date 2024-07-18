@extends('layouts.dashboard')
@section('content')
    <!-- tag-form.blade.php -->
    <div class="w-3/4 mx-auto py-10">

        <form class="bg-white shadow-2xl rounded px-8 pt-6 pb-8 mb-4" method="post"
            action="{{ request()->routeIs('tags.create') ? route('tags.store') : route('tags.update', $tag) }}">
            @csrf
            @if (isset($tag))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="name">
                    {{ request()->routeIs('tags.create') ? __('Create New tag') : __('Edit tag') }}
                </label>
                <input
                    class="shadow appearance-none border rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                    id="name" type="text" name="name"
                    value="{{ request()->routeIs('tags.create') ? old('name') : old('name', $tag->name) }}" required>
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    {{ request()->routeIs('tags.create') ? '+ Create' : '+ Update' }}
                </button>
            </div>
        </form>
    </div>
@endsection
