@extends('layouts.pageTemplate')
@section('home-active', 'active')
@section('content')
    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>



        <!-- hero section -->
        <section id="hero">

            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">

                        <!-- featured post large -->
                        {{-- @foreach ($featuredposts as $featuredpost) --}}
                        @if ($post == '')
                            <p class="text-center">No post have been featured...</p>
                            <p class="text-center">Try featuring some...</p>
                        @else
                            <div class="post featured-post-lg">
                                <div class="details clearfix">
                                    <a href="{{ route('categoryPost', $post->category) }}"
                                        class="category-badge">{{ $post->category->name }}</a>
                                    <h2 class="post-title"><a
                                            href="{{ route('viewArticle', $post->uuid) }}">{{ $post->name }}</a>
                                    </h2>
                                    <ul class="meta list-inline mb-0">
                                        <li class="list-inline-item"><a
                                                href="{{ route('author', $post->user) }}">{{ $post->user->name }}</a>
                                        </li>
                                        <li class="list-inline-item">{{ $post->updated_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                                <a href="{{ route('viewArticle', $post) }}">
                                    <div class="thumb rounded">
                                        <div class="inner data-bg-image" data-bg-image="{{ $post->image }}">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        {{-- @endforeach --}}


                    </div>

                    <div class="col-lg-4">

                        <!-- post tabs -->
                        <div class="post-tabs rounded bordered">
                            <!-- tab navs -->
                            <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
                                <li class="nav-item" role="presentation"><button aria-controls="popular"
                                        aria-selected="true" class="nav-link active" data-bs-target="#popular"
                                        data-bs-toggle="tab" id="popular-tab" role="tab" type="button">Popular</button>
                                </li>
                                <li class="nav-item" role="presentation"><button aria-controls="recent"
                                        aria-selected="false" class="nav-link" data-bs-target="#recent" data-bs-toggle="tab"
                                        id="recent-tab" role="tab" type="button">Recent</button></li>
                            </ul>
                            <!-- tab contents -->
                            <div class="tab-content" id="postsTabContent">
                                <!-- loader -->
                                <div class="lds-dual-ring"></div>
                                <!-- popular posts -->
                                <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular"
                                    role="tabpanel">
                                    <!-- post -->
                                    @if ($mostPopularDesc != '')
                                        @foreach ($mostPopularDesc as $post)
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <a href="{{ route('viewArticle', $post) }}">
                                                        <div class="inner">
                                                            <img src="{{ $post->image }}" alt="post-title"
                                                                style="object-fit: cover; height:3.6rem;" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0"><a
                                                            href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">
                                                            {{ $post->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">You have no popular post...</p>
                                        <p class="text-center">Try viewing some posts...</p>
                                    @endif

                                </div>
                                <!-- recent posts -->
                                <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
                                    <!-- post -->
                                    @if ($latestPosts != '')
                                        @foreach ($latestPosts as $post)
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <a href="{{ route('viewArticle', $post) }}">
                                                        <div class="inner">
                                                            <img src="{{ $post->image }}" alt="post-title"
                                                                style="object-fit: cover; height:3.6rem;" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0"><a
                                                            href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">
                                                            {{ $post->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">You have no recent post...</p>
                                        <p class="text-center">Try creating some posts...</p>
                                    @endif



                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section>

        <!-- section main content -->
        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">

                        <!-- section header -->
                        <div class="section-header " style="margin-top: 2rem">
                            <h3 class="section-title">Editor’s Pick</h3>
                            <img src="images/wave.svg" class="wave" alt="wave" />
                        </div>

                        <div class="padding-30 rounded bordered">
                            <div class="row gy-5">
                                <div class="col-sm-6">
                                    <!-- post -->
                                    @if ($firstPick != '')
                                        <div class="post">
                                            <div class="thumb rounded">
                                                <a href="{{ route('categoryPost', $firstPick->category) }}"
                                                    class="category-badge position-absolute">{{ $firstPick->category->name }}</a>
                                                <span class="post-format">
                                                    <i class="icon-picture"></i>
                                                </span>
                                                <a href="{{ route('viewArticle', $firstPick) }}">
                                                    <div class="inner">
                                                        <img src="{{ $firstPick->image }}" alt="post-title" loading='lazy"/>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <ul class="meta list-inline mt-4 mb-0">
                                                                            <li class="list-inline-item"><a
                                                                                    href="{{ route('author', $firstPick->user) }}"><img
                                                                                        src="{{ $firstPick->user->profile_photo }}" class="author"
                                                                                        alt="author"
                                                                                        style="height:1.5rem; width:1.5rem; object-fit: cover; border-radius: 50%;" />{{ $firstPick->user->name }}</a>
                                                                            </li>
                                                                            <li class="list-inline-item">{{ $firstPick->created_at->diffForHumans() }}
                                                                            </li>
                                                                        </ul>
                                                                        <h5 class="post-title mb-3 mt-3"><a
                                                                                href="{{ route('viewArticle', $firstPick) }}">{{ $firstPick->name }}</a>
                                                                        </h5>
                                                                        <p class="excerpt mb-0">{!! trim(Str::limit($firstPick->description, 100)) !!}</p>
                                                                    </div>
@else
    <p class="text-center mt-5">You have Editor picks...</p>
                                                                    <p class="text-center">Try picking some posts...</p>
    @endif

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <!-- post -->
                                                                @if ($editorPicks != '')
                                                                    @foreach ($editorPicks as $post)
    <div class="post post-list-sm square">
                                                                            <div class="thumb rounded">
                                                                                <a href="{{ route('viewArticle', $post) }}">
                                                                                    <div class="inner">
                                                                                        <img src="{{ $post->image }}" alt="post-title" />
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div class="details clearfix">
                                                                                <h6 class="post-title my-0"><a
                                                                                        href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                                                                </h6>
                                                                                <ul class="meta list-inline mt-1 mb-0">
                                                                                    <li class="list-inline-item">
                                                                                        {{ $post->created_at->diffForHumans() }}</li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
    @endforeach
@else
    <p class="text-center mt-5">You have Editor picks...</p>
                                                                    <p class="text-center">Try picking some posts...</p>
                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="spacer" data-height="30"></div>


                                                    <!-- section header -->
                                                    <div class="section-header">
                                                        <h3 class="section-title">Latest Posts</h3>
                                                        <img src="images/wave.svg" class="wave" alt="wave" />
                                                    </div>

                                                    <div class="padding-30 rounded bordered">

                                                        <div class="row">

                                                            <div class="col-md-12 col-sm-6">
                                                                <!-- post -->
                                                                @if ($posts != '')
                                                                    @foreach ($posts as $post)
    <div class="post post-list clearfix">
                                                                            <div class="thumb rounded">
                                                                                <span class="post-format-sm">
                                                                                    <i class="icon-picture"></i>
                                                                                </span>
                                                                                <a href="{{ route('viewArticle', $post) }}">
                                                                                    <div class="inner">
                                                                                        <img src="{{ $post->image }}" alt="post-title" />
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div class="details">
                                                                                <ul class="meta list-inline mb-3">
                                                                                    <li class="list-inline-item"><a
                                                                                            href="{{ route('author', $post->user) }}"><img
                                                                                                src="{{ $post->user->profile_photo }}"
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
                                                                                <p class="excerpt mb-0">{!! Str::limit($post->description, 100) !!}</p>
                                                                                {{-- <div class="post-bottom clearfix d-flex align-items-center">

                                                    <div class="more-button float-end">
                                                        <a href="{{ route('viewArticle', $post) }}"><span
                                                                class="icon-options"></span></a>
                                                    </div>
                                                </div> --}}

                                                                                <div class="post-bottom clearfix d-flex align-items-center">
                                                                                    <livewire:clap-button :post="$post" />

                                                                                </div>
                                                                            </div>
                                                                        </div>
    @endforeach
@else
    <p class="text-center mt-5">You have Editor picks...</p>
                                                                    <p class="text-center">Try picking some posts...</p>
                                                                @endif


                                                            </div>

                                                        </div>
                                                        <!-- load more button -->
                                                        <div class="text-center">
                                                            <a href="{{ route('topics') }}" class="btn btn-simple ">Load More</a>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-lg-4">

                                                    <!-- sidebar -->
                                                    <div class="sidebar" style="height: 1rem; position: relative;">
                                                        <!-- widget about -->
                                                        <div class="widget rounded">
                                                            <div class="widget-about data-bg-image text-center" data-bg-image="images/map-bg.png">
                                                                <img src="images/thotlogo.png" alt="logo" class="" style="height: 9vh" />
                                                                <p class="mb-4">Hey there, We are expert content writers, specializing in Tech and
                                                                    other related content. Our goal is to help clients reach their target
                                                                    audience with captivating content.</p>
                                                                <ul class="social-icons list-unstyled list-inline mb-0">
                                                                    <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                                                                                class="fab fa-facebook-f"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                                                                                class="fab fa-twitter"></i></a></li>
                                                                    <li class="list-inline-item"><a
                                                                            href="https://www.instagram.com/japheth_joepari/"><i
                                                                                class="fab fa-instagram"></i></a></li>
                                                                    {{-- <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                                    class="fab fa-medium"></i></a></li> --}}
                                                                    {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <!-- widget popular posts -->
                                                        <div class="widget rounded">
                                                            <div class="widget-content">

                                                                <!-- widget categories -->
                                                                <div class="widget rounded">
                                                                    <div class="widget-header text-center">
                                                                        <h3 class="widget-title">Explore Topics</h3>
                                                                        <img src="images/wave.svg" class="wave" alt="wave" />
                                                                    </div>
                                                                    <div class="widget-content">
                                                                        <ul class="list">
                                                                            @if ($categories != '')
                                                                                @foreach ($categories as $category)
    <li><a
                                                                                            href="{{ route('categoryPost', $category) }}">{{ $category->name }}</a><span>({{ $category->post_count }})</span>
                                                                                    </li>
    @endforeach
@else
    <p class="text-center mt-5">You topics is empty...</p>
                                                                                <p class="text-center">Try creating some topics...</p>
                                                                            @endif


                                                                        </ul>
                                                                    </div>

                                                                </div>

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
                                                                        <img src="images/wave.svg" class="wave" alt="wave" />
                                                                    </div>
                                                                    <div class="widget-content">
                                                                        @if ($tags != '')
                                                                            @foreach ($tags as $tag)
    <a href="{{ route('tagPost', $tag) }}"
                                                                                    class="tag">#{{ $tag->name }}</a>
    @endforeach
@else
    <p class="text-center mt-5">Your tag list is empty...</p>
                                                                            <p class="text-center">Try creating some tags...</p>
                                                                        @endif

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                    </section>
    @endsection
