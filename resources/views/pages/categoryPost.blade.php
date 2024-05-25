@extends('layouts.pageTemplate')
@section('content')
@section('topics-active', 'active')
<!-- site wrapper -->
<div class="site-wrapper">

    <div class="main-overlay"></div>

    <!-- header -->


    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">{{ $category->name }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content-lg">
        <div class="container-minimal">
            <!-- post -->
            @foreach ($posts as $post)
                <div class="post post-xl">
                    <!-- top section -->
                    <div class="post-top">
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('author', $post->user) }}">
                                    @if ($post->user->profile_photo == null)
                                        <img src="{{ asset('images/avartar.png') }}" class="author" alt="author"
                                            style="height: 2rem; width:3.6rem; border-radius:50%" />{{ $post->user->name }}
                                </a>
                            @else
                                <img src="{{ asset('images/' . $post->user->profile_photo) }}" class="author"
                                    alt="author"
                                    style="height: 2rem; width:2rem; border-radius:50%" />{{ $post->user->name }}</a>
            @endif

            </li>
            <li class="list-inline-item">{{ $post->updated_at->diffForHumans() }}</li>
            <li class="list-inline-item"><i class="icon-bubble"></i> ({{ $post->comments()->count() }})</li>
            </ul>
            <h5 class="post-title mb-0 mt-4"><a href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
            </h5>
        </div>
        <!-- thumbnail -->
        <div class="thumb rounded">
            <a href="{{ route('categoryPost', $post->category) }}"
                class="category-badge lg position-absolute">{{ $post->category->name }}</a>
            <span class="post-format">
                <i class="icon-picture"></i>
            </span>
            <a href="{{ route('viewArticle', $post) }}">
                <div class="inner">
                    <img src="{{ asset('images/' . $post->image) }}" alt="post-title"
                        style="width: 100%; height:60vh; object-fit:cover;" />
                </div>
            </a>
        </div>
        <!-- details -->
        <div class="details">
            <p class="excerpt mb-0">{{ Str::limit($post->description, 500) }}</p>
        </div>
        <div class="post-bottom clearfix d-flex align-items-center">
            <div class="social-share me-auto">
                <div class="social-share me-auto">
                    <livewire:clap-button :post="$post" />
                </div>
            </div>
            <div class="float-end d-none d-md-block">
                <a href="{{ route('viewArticle', $post) }}" class="more-link">Continue reading<i
                        class="icon-arrow-right"></i></a>
            </div>

        </div>
</div>
@endforeach

<!-- pagination -->
<nav>
    <div class="pagination justify-content-center">
        {{ $posts->links('vendor.pagination.bootstrap-4', ['prev_text' => 'Previous Page', 'next_text' => 'Next Page', 'class' => 'my-pagination']) }}
    </div>
</nav>
</div>
</section>

</div><!-- end site wrapper -->


@endsection
