@extends('layouts.pageTemplate')
@section('content')
    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- cover header -->
        <section class="single-cover data-bg-image" data-bg-image="{{ asset('images/' . $post->image) }}">

            <div class="container-xl">

                <div class="cover-content post">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $post->category->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $post->name }}
                            </li>
                        </ol>
                    </nav>

                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3">{{ $post->name }}</h1>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('author', $post->user) }}"><img
                                        src="{{ asset('images/' . $post->user->profile_photo) }}"
                                        class="author rounded-circle" alt="author"
                                        style="height: 5vh; width:5vh" />{{ $post->user->name }}</a>
                            </li>
                            <li class="list-inline-item"><a href="blog-single-alt.html#">Trending</a></li>
                            <li class="list-inline-item">{{ $post->created_at->diffForHumans() }}</li>
                        </ul>
                    </div>
                </div>

            </div>

        </section>

        <!-- section main content -->
        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">
                        <!-- post single -->
                        <div class="post post-single">
                            <!-- post content -->
                            <div class="post-content clearfix">
                                <p>{!! $post->description !!}</p>
                            </div>
                            <!-- post bottom section -->
                            <div class="post-bottom">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6 col-12 text-center text-md-start">
                                        <!-- tags -->
                                        @foreach ($post->tags as $tag)
                                            <a href="blog-single-alt.html#" class="tag"># {{ $tag->name }}</a>
                                        @endforeach

                                    </div>
                                    <div class="col-md-6 col-12">
                                        <!-- social icons -->
                                        <div class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                            <livewire:clap-button :post="$post" />
                                        </div>
                                    </div>
                                </div>
                                <div class="more-button col-md-6 col-12">



                                </div>
                            </div>
                        </div>

                        <div class="spacer" data-height="50"></div>

                        <div class="about-author padding-30 rounded">
                            <div class="thumb">
                                <img src="{{ asset('images/' . $post->user->profile_photo) }}" alt="Katen Doe" />
                            </div>
                            <div class="details">
                                <h4 class="name"><a href="blog-single-alt.html#">{{ $post->user->name }}</a></h4>
                                <p>Hello, I’m a content writer who is fascinated by content fashion, celebrity and
                                    lifestyle. She helps clients bring the right content to the right people.</p>
                                <!-- social icons -->
                                <ul class="social-icons list-unstyled list-inline mb-0">
                                    <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                class="fab fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                class="fab fa-medium"></i></a></li>
                                    <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="spacer" data-height="50"></div>

                        <!-- section header -->
                        <div class="section-header">
                            <h3 class="section-title">Comments</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                        </div>
                        <!-- post comments -->
                        <div class="comments bordered padding-30 rounded">



                            <livewire:comments :post="$post" />
                        </div>

                        <div class="spacer" data-height="50"></div>

                        <!-- section header -->


                        {{-- </div> --}}
                    </div>

                    <div class="col-lg-4">

                        <!-- sidebar -->
                        <div class="sidebar">
                            <!-- widget about -->
                            <div class="widget rounded">
                                <div class="widget-about data-bg-image text-center" data-bg-image="images/map-bg.png">
                                    <img src="{{ asset('images/thotlogo.png') }}" alt="logo" class="mb-2"
                                        style="height: 17vh" />
                                    <p class="mb-4">Hello, We’re content writer who is fascinated by content fashion,
                                        celebrity and lifestyle. We helps clients bring the right content to the right
                                        people.</p>
                                    <ul class="social-icons list-unstyled list-inline mb-0">
                                        <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                    class="fab fa-instagram"></i></a></li>
                                        <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                    class="fab fa-pinterest"></i></a></li>
                                        <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                    class="fab fa-medium"></i></a></li>
                                        <li class="list-inline-item"><a href="blog-single-alt.html#"><i
                                                    class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- widget popular posts -->
                            <div class="widget rounded">

                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Popular Posts</h3>
                                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                                </div>
                                <div class="widget-content">
                                    @foreach ($mostPopularDesc as $post)
                                        <div class="post post-list-sm circle">
                                            <div class="thumb circle">
                                                <span class="number">{{ $post->views_count }}</span>
                                                <a href="{{ route('viewArticle', $post) }}">
                                                    <div class="inner">
                                                        <img src="{{ asset('images/' . $post->image) }}" alt="post-title"
                                                            style="height: 6.7vh; width:7vh" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0"><a
                                                        href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                                </h6>
                                                <ul class="meta list-inline mt-1 mb-0">
                                                    <li class="list-inline-item">{{ $post->created_at->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- post -->


                                </div>
                            </div>

                            <!-- widget categories -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Explore Topics</h3>
                                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
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

                            </div>

                            <!-- widget newsletter -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Newsletter</h3>
                                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                                </div>
                                <div class="widget-content">
                                    <span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
                                    <form>
                                        <div class="mb-2">
                                            <input class="form-control w-100 text-center" placeholder="Email address…"
                                                type="email">
                                        </div>
                                        <button class="btn btn-default btn-full" type="submit">Sign Up</button>
                                    </form>
                                    <span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a
                                            href="blog-single-alt.html#">Privacy Policy</a></span>
                                </div>
                            </div>


                            <!-- widget tags -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Tag Clouds</h3>
                                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                                </div>
                                <div class="widget-content">
                                    @foreach ($tags as $tag)
                                        <a href="{{ route('tagPost', $tag) }}" class="tag">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div><!-- end site wrapper -->
@endsection
