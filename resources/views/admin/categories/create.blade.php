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
    <!-- category-form.blade.php -->
    <div class="w-3/4  mx-auto py-10 ">

        <form class="bg-white shadow-2xl rounded px-8 pt-6 pb-8 mb-4" method="post"
            action="{{ request()->routeIs('categories.create') ? route('categories.store') : route('categories.update', $category) }}">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="name">
                    {{ request()->routeIs('categories.create') ? __('Create New Category') : __('Edit Category') }}
                </label>
                <input
                    class="shadow appearance-none border rounded w-full
      py-2 px-3 text-gray-700 leading-tight focus:outline-none
      focus:shadow-outline"
                    id="name" type="text" name="name"
                    value="{{ request()->routeIs('categories.create') ? old('name') : old('name', $category->name) }}"
                    required>
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    {{ request()->routeIs('categories.create') ? '+ Create' : '+ Update' }}
                </button>
            </div>
        </form>
    </div>
@endsection
