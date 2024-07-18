@extends('layouts.pageTemplate')
@section('topics-active', 'active')
@section('content')
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- section hero -->
        <section class="single-cover2  data-bg-image" data-bg-image="{{ url('images/banner.webp') }}">

            <div class="container-xl">

                <div class="cover-content post">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Read all stories</a>
                            </li>

                        </ol>
                    </nav>

                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3">Stories For you</h1>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="#">Trending</a></li>
                        </ul>
                        <button id="scroll-button" class="btn btn-light mt-2 scroll-button">Scroll down</button>
                    </div>
                </div>

            </div>

        </section>

        <!-- hero section -->
        <section id="hero">

            <div class="container-xl">


            </div>

        </section>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- section main content -->
        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">

                        <!-- section header -->



                        <div class="spacer" data-height="30"></div>


                        <!-- section header -->
                        <div class="section-header" id="target-element">
                            <h3 class="section-title"> Articles</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                        </div>

                        @if ($latestPosts != '')
                            <div class="padding-30 rounded bordered">

                                <div class="row">

                                    <div class="col-md-12 col-sm-6">
                                        <!-- post -->
                                        @foreach ($latestPosts as $post)
                                            <div class="post post-list clearfix" id="sction">
                                                <div class="thumb rounded">
                                                    <span class="post-format-sm">
                                                        <i class="icon-picture"></i>
                                                    </span>
                                                    <a href="{{ route('viewArticle', $post) }}">
                                                        <div class="inner">
                                                            <img src="{{ asset('images/' . $post->image) }}"
                                                                alt="post-title" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details">
                                                    <ul class="meta list-inline mb-3">
                                                        <li class="list-inline-item"><a
                                                                href="{{ route('author', $post->user) }}"><img
                                                                    @if ($post->user->profile_photo == '') src="{{ asset('images/avartar.png') }}"
                                                                    @else
                                                                    src="{{ asset('images/' . $post->user->profile_photo) }}" @endif
                                                                    class="author" alt="author"
                                                                    style="object-fit: cover; height:1.6rem; width:1.6rem; border-radius:50%;" />{{ $post->user->name }}</a>
                                                        </li>
                                                        <li class="list-inline-item"><a
                                                                href="{{ route('categoryPost', $post->category) }}">{{ $post->category->name }}</a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            {{ $post->created_at->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                    <h5 class="{{ route('viewArticle', $post) }}"><a
                                                            href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                                    </h5>
                                                    <p class="excerpt mb-0">A wonderful serenity has taken possession
                                                        of my
                                                        entire soul, like these sweet mornings</p>
                                                    <div class="post-bottom clearfix d-flex align-items-center">

                                                        <div class="more-button float-start">

                                                            <livewire:clap-button :post="$post" />

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                                <!-- load more button -->
                                <div class="text-center">
                                    {{ $latestPosts->links('vendor.pagination.bootstrap-4', ['prev_text' => 'Previous Page', 'next_text' => 'Next Page', 'class' => 'my-pagination']) }}
                                </div>

                            </div>
                        @else
                            <p class="text-center mt-5">You have Editor picks...</p>
                            <p class="text-center">Try picking some posts...</p>
                        @endif


                    </div>
                    <div class="col-lg-4">

                        <!-- sidebar -->
                        <div class="sidebar" style="height: 1rem; position: relative;">
                            <!-- widget about -->
                            <div class="widget rounded">
                                <div class="widget-about data-bg-image text-center"
                                    data-bg-image="{{ asset('images/map-bg.png') }}">
                                    <img src="{{ asset('images/thotlogo.png') }}" alt="logo" class=""
                                        style="height: 6rem" />
                                    <p class="mb-4">Hey there, We are expert content writers, specializing in Tech and
                                        other related content. Our goal is to help clients reach their target
                                        audience with captivating content.</p>
                                    <ul class="social-icons list-unstyled list-inline mb-0">
                                        <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                                                    class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                                                    class="fab fa-instagram"></i></a></li>
                                        {{-- <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                                    class="fab fa-medium"></i></a></li> --}}
                                        {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- widget popular posts -->
                            @if ($latestPosts != '')
                                <div class="widget rounded">
                                    <div class="widget-header text-center">
                                        <h3 class="widget-title">Popular Posts</h3>
                                        <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                                    </div>
                                    <div class="widget-content">
                                        <!-- post -->
                                        @foreach ($mostPopularDesc as $post)
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <span class="number">{{ $post->views_count }}</span>
                                                    <a href="{{ route('viewArticle', $post) }}">
                                                        <div class="inner">
                                                            <img src="{{ asset('images/' . $post->image) }}"
                                                                alt="post-title"
                                                                style="object-fit: cover; height:3.6rem;" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0"><a
                                                            href="{{ route('viewArticle', $post) }}">
                                                            {{ $post->name }}</a></h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">
                                                            {{ $post->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- widget categories -->
                                        {{-- <div class="widget rounded">
                                        <div class="widget-header text-center">
                                            <h3 class="widget-title">Explore Topics</h3>
                                            <img src="images/wave.svg" class="wave" alt="wave" />
                                        </div>
                                        <div class="widget-content">
                                            <ul class="list">
                                                @foreach ($categories as $category)
                                                    <li><a
                                                            href="{{ route('categoryPost', $category) }}">{{ $category->name }}</a><span>({{ $category->post_count }})</span>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>

                                    </div> --}}

                                        <!-- widget newsletter -->
                                        <div class="widget rounded">
                                            <div class="widget-header text-center">
                                                <h3 class="widget-title">Newsletter</h3>
                                                <img src="images/wave.svg" class="wave" alt="wave" />
                                            </div>
                                            <div class="widget-content">
                                                @if (Auth::user())
                                                    <h4 class="newsletter-headline text-center mb-3">Thanks for
                                                        subscribing</h4>
                                                    <small class="newsletter-headline text-success text-center mb-3">Over
                                                        300
                                                        subscribers</small>
                                                @else
                                                    <span class="newsletter-headline text-center mb-3">Join 300
                                                        subscribers!</span>
                                                    <form action="{{ route('login') }}" method="get">
                                                        @csrf
                                                        <div class="mb-2">
                                                        </div>
                                                        <button class="btn btn-default btn-full" type="submit">Subscribe
                                                        </button>
                                                    </form>
                                                    <span class="newsletter-privacy text-center mt-3">By signing up, you
                                                        agree
                                                        find to our
                                                @endif

                                            </div>
                                        </div>

                                        <!-- widget tags -->
                                        <div class="widget rounded">
                                            <div class="widget-header text-center">
                                                <h3 class="widget-title">Tag Clouds</h3>
                                                <img src="{{ asset('images/wave.svg') }}" class="wave"
                                                    alt="wave" />
                                            </div>
                                            <div class="widget-content">
                                                @foreach ($tags as $tag)
                                                    <a href="{{ route('tagPost', $tag) }}"
                                                        class="tag">#{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            @endif


                        </div>

                    </div>
        </section>


    </div><!-- end site wrapper -->
@endsection
