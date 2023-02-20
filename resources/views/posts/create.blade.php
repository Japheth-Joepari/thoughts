@extends('layouts.dashboard')
@section('content')
    <div class=" w-3/4  mx-auto py-10">
        <form class=" bg-white rounded px-8 pt-6 pb-8 mb-4"
            action="{{ request()->routeIs('posts.edit') ? route('posts.update', $post) : route('posts.store') }}"
            method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($post))
                @method('put')
            @endif

            <h2 class="text-2xl font-bold mb-6">
                {{ request()->routeIs('posts.edit') ? __('Update Post') : __('Create Post') }}</h2>

            <!-- Name Field -->
            <div class="w-full mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="name">
                    Topic
                </label>
                <input class="border border-gray-400 p-2 w-full" type="text" id="name" name="name" required
                    value="{{ request()->routeIs('posts.edit') ? old('name', $post->name) : old('name') }}">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="w-full mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="description">
                    Description
                </label>
                {{-- Laravel CKEditor --}}
                <textarea class="border border-gray-400 p-2 w-full" id="description" name="description">{{ request()->routeIs('posts.edit') ? old('description', $post->description) : old('name') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Image Upload and Preview Field -->

            <div class="mb-4 w-full">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image</label>
                <input type="file" name="image" id="image"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    onchange="previewImage(this)"
                    value="{{ request()->routeIs('posts.edit') ? old('image', $post->image) : old('image') }}"
                    autocomplete="image">
                @error('image')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
                <img id="imagePreview" src="" alt="Preview" class="hidden mt-2">

                @if (request()->routeIs('posts.edit'))
                    @if ($post && $post->image)
                        <img src="{{ asset('/images/' . $post->image) }}" alt="Post Image" />
                    @endif
                @endif
            </div>

            <!-- Choose Tags Field -->
            <div class="w-full mb-6 bg-white">
                <label class="block text-gray-700 font-bold mb-2" for="tags">
                    Choose Tags
                </label>
                <select class="border border-gray-400 p-2 w-full bg-white" id="tags" name="tags[]" multiple>
                    {{-- Laravel Loop to display options --}}
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) || (isset($post) && $post->tags->contains($tag->id)) ? 'selected' : '' }}>
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                <select name="category_id" id="category_id"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option
                        value="{{ request()->routeIs('posts.edit') ? old('category_id', $post->category_id) : old('category_id') }}">
                        Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', isset($post) && $post->category_id == $category->id ? 'selected' : '') }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>



            <!-- Submit Button -->
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                {{ request()->routeIs('posts.edit') ? ' + update' : ' + create' }}
            </button>

        </form>



    </div>
@endsection


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
</script>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).removeClass('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
