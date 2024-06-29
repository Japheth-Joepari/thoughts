@extends('layouts.pageTemplate')
@section('write-active', 'active')
@section('content')
    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>
        <section class="single-cover2  data-bg-image" data-bg-image="{{ asset('images/write.jpg') }}">

            <div class="container-xl">

                <div class="cover-content post">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">publish your article</a>
                            </li>

                        </ol>
                    </nav>

                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3">{{ isset($post) ? 'Update Article' : 'New Article' }} </h1>
                        <button id="scroll-button" class="btn btn-light mt-2 scroll-button">Scroll down</button>
                    </div>
                </div>

            </div>

        </section>

        <section class="main-content">
            <div class="container-xl">
                <div class="spacer" data-height="50"></div>

                <!-- section header -->
                <div class="section-header">
                    <h3 class="section-title" id="sction">{{ isset($post) ? ' + Edit Article' : 'Write Article' }}</h3>
                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                </div>

                <!-- Contact Form -->
                <form id="contact-form" action="{{ isset($post) ? route('updateArticle', $post) : route('storeArticle') }}"
                    class="contact-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="messages"></div>

                    <div class="row">
                        <div class="column col-md-12">
                            <!-- Title input -->
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Title"
                                    value="{{ request()->routeIs('editArticle') ? old('name', $post->name) : old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="column col-md-12">
                            <!-- Description textarea -->
                            <div class="form-group">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="9" placeholder="Description..." required>{{ isset($post) ? old('description', $post->description) : old('name') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="column col-md-12">
                            <!-- Image input -->
                            <div class="form-group">
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" onchange="previewImage(this)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img id="imagePreview"
                                    @if (isset($post)) src="{{ $post->image }}"
                                        class="d-block"
                                        @else
                                        src=""
                                        class="d-none" @endif
                                    loading="lazy">

                            </div>
                        </div>

                        <div class="column col-md-12">
                            <!-- Category select -->
                            <div class="form-group">
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    <option
                                        value="{{ request()->routeIs('editArticle') ? old('category_id', $post->category_id) : old('category_id') }}">
                                        Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', isset($post) && $post->category_id == $category->id ? 'selected' : '') }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="column col-md-12">
                            <!-- Tags select -->
                            <div class="form-group">


                                <select class="form-control chosen-select @error('tags') is-invalid @enderror" multiple
                                    id="tags" name="tags[]" multiple>
                                    {{-- Laravel Loop to display options --}}
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) || (isset($post) && $post->tags->contains($tag->id)) ? 'selected' : '' }}>
                                            {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="submit" id="submit" value="Submit" class="btn btn-default">
                        {{ isset($post) ? '+ Update Article' : 'Create Article' }}
                    </button>

                </form>
            </div>

        </section>

    </div><!-- end site wrapper -->

    {{-- summernote Begins --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#description').summernote({
            placeholder: 'Write Someting ...',
            tabsize: 2,
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['color', ['color']],
                ['fontname', ['fontname']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['code', ['code']],

                ['hr', ['hr']],
                ['superscript', ['superscript']],
                ['subscript', ['subscript']],
                ['anchor', ['anchor']],

            ],
            codemirror: {
                theme: 'monokai',
                lineNumbers: true,
                mode: 'text/html',
                htmlMode: true
            },

            popover: {
                image: [
                    ['custom', ['caption', 'imageAttributes']],
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ]
            },

            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Times New Roman'],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '36', '48', '64', '72', '96'],

        });
    </script>
    {{-- summernote ends --}}



    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $('#tags').select2({
            placeholder: "Select tags"
        });

        $('#category_id').select2({
            placeholder: "Select categories"
        });
    </script>
@endsection
