@extends('layouts.pageTemplate')
@section('content')
    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- header -->
        <header class="header-default   ">
            <nav class="navbar navbar-expand-lg">
                <div class="container-xl nv">
                    <!-- site logo -->
                    <a class="navbar-brand " href="{{ route('home') }}"><img src="{{ asset('images/thotlogo.png') }}"
                            alt="logo" class="img" /></a>

                    <div class="collapse navbar-collapse">
                        <!-- menus -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown ">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('explore') }}">Explore</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('topics') }}">Topics</a>
                            </li>

                            @if (Auth::user())
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('write') }}">Write</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('authors') }}">Authors</a>
                                </li>
                            @else
                                <a class="nav-link" style="color:#ad1deb" href="{{ route('login') }}">SignIn</a>
                                </li>
                            @endif


                        </ul>
                    </div>

                    <!-- header right section -->
                    <div class="header-right">
                        <!-- social icons -->
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                        class="fab fa-medium"></i></a></li>
                            {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                            </li>
                        </ul>
                        <!-- header buttons -->
                        <div class="header-buttons">

                            @if (!Auth::user())
                                <a class="btn btn-primary" href="{{ route('register') }}"
                                    style="background: rgb(0, 0, 0); color:">Get
                                    started</a>
                            @else
                                @auth
                                    @if (Auth::user()->profile_photo != null)
                                        <button class=" burger-menu2 b2" href="#"
                                            style="background: transparent; border:none; width:3.4rem;">
                                            <img class=" rounded-circle img-fluid "
                                                src="{{ asset('/images/' . Auth::user()->profile_photo) }}" alt="Your avatar">
                                        </button>
                                    @else
                                        <button class=" burger-menu2 b2" href="#"
                                            style="background: transparent; border:none; width:3.4rem;">
                                            <img class=" rounded-circle img-fluid " src="{{ asset('/images/avartar.png') }}"
                                                alt="Your avatar">
                                        </button>
                                    @endif
                                @endauth
                            @endif


                            <button class="search icon-button">
                                <i class="icon-magnifier"></i>
                            </button>
                            <button class="burger-menu icon-button d-xl-none ">
                                <span class="burger-icon "></span>
                            </button>

                            <form id="myForm" action="{{ route('logout') }}" method="POST" style="display: none">
                                @csrf
                                <!-- form fields go here -->
                            </form>
                            @auth

                                <a class="icon-button b1" href="#" onclick="document.getElementById('myForm').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class=""
                                        style="height: 1rem" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                </a>



                            @endauth

                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- section hero -->
        <section class="single-cover2  data-bg-image" data-bg-image="{{ asset('images/reddog.jpeg') }}">

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
                    </div>
                </div>

            </div>

        </section>

        <!-- hero section -->
        <section id="hero">

            <div class="container-xl">


            </div>

        </section>

        <!-- section main content -->
        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">

                        <!-- section header -->



                        <div class="spacer" data-height="30"></div>


                        <!-- section header -->
                        <div class="section-header">
                            <h3 class="section-title"> Articles</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                        </div>

                        <div class="padding-30 rounded bordered">

                            <div class="row">

                                <div class="col-md-12 col-sm-6">
                                    <!-- post -->
                                    @foreach ($latestPosts as $post)
                                        <div class="post post-list clearfix">
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
                                                                src="{{ 'images/' . $post->user->profile_photo }}"
                                                                class="author" alt="author"
                                                                style="object-fit: cover; height:1.6rem; width:1.6rem; border-radius:50%;" />{{ $post->user->name }}</a>
                                                    </li>
                                                    <li class="list-inline-item"><a
                                                            href="{{ route('categoryPost', $post->category) }}">{{ $post->category->name }}</a>
                                                    </li>
                                                    <li class="list-inline-item">{{ $post->created_at->diffForHumans() }}
                                                    </li>
                                                </ul>
                                                <h5 class="{{ route('viewArticle', $post) }}"><a
                                                        href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                                </h5>
                                                <p class="excerpt mb-0">A wonderful serenity has taken possession
                                                    of my
                                                    entire soul, like these sweet mornings</p>
                                                <div class="post-bottom clearfix d-flex align-items-center">

                                                    <div class="more-button float-end">
                                                        <a href="{{ route('viewArticle', $post) }}"><span
                                                                class="icon-options"></span></a>
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
                                    <p class="mb-4">Hello, We’re content writer who is fascinated by content fashion,
                                        celebrity and lifestyle. We helps clients bring the right content to the right
                                        people.</p>
                                    <ul class="social-icons list-unstyled list-inline mb-0">
                                        <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                                                    class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a
                                                href="https://www.instagram.com/japheth_joepari/"><i
                                                    class="fab fa-instagram"></i></a></li>
                                        <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                                    class="fab fa-medium"></i></a></li>
                                        {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                                        </li>
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
                                    <!-- post -->
                                    @foreach ($mostPopularDesc as $post)
                                        <div class="post post-list-sm circle">
                                            <div class="thumb circle">
                                                <span class="number">{{ $post->views_count }}</span>
                                                <a href="{{ route('viewArticle', $post) }}">
                                                    <div class="inner">
                                                        <img src="{{ asset('images/' . $post->image) }}" alt="post-title"
                                                            style="object-fit: cover; height:3.6rem;" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0"><a href="{{ route('viewArticle', $post) }}">
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
                                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                                        </div>
                                        <div class="widget-content">
                                            <span class="newsletter-headline text-center mb-3">Join 70,000
                                                subscribers!</span>
                                            <form>
                                                <div class="mb-2">
                                                    <input class="form-control w-100 text-center"
                                                        placeholder="Email address…" type="email">
                                                </div>
                                                <button class="btn btn-default btn-full" type="submit">Sign
                                                    Up</button>
                                            </form>
                                            <span class="newsletter-privacy text-center mt-3">By signing up, you agree
                                                find to our
                                                <a href="index.html#">Privacy Policy</a></span>
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
                                                <a href="{{ route('tagPost', $tag) }}"
                                                    class="tag">#{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
        </section>


        <!-- footer -->
        <footer>
            <div class="container-xl">
                <div class="footer-inner">
                    <div class="row d-flex align-items-center gy-4">
                        <!-- copyright text -->
                        <div class="col-md-4">
                            <span class="copyright">© 2023 Thoughts. Made with &#x1F493; by Japheth Joepari.</span>
                        </div>

                        <!-- social icons -->
                        <div class="col-md-4 text-center">
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                            class="fab fa-medium"></i></a></li>
                                {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                                </li>
                            </ul>
                        </div>

                        <!-- go to top button -->
                        <div class="col-md-4">
                            <a href="index.html#" id="return-to-top" class="float-md-end"><i
                                    class="icon-arrow-up"></i>Back to Top</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    <div class="search-popup">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- content -->
        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>
            <!-- form -->
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Search and press enter ..."
                    aria-label="Search">
                <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
            </form>
        </div>
    </div>

    <!-- canvas menu -->
    <div class="canvas-menu d-flex align-items-end flex-column">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>

        <!-- logo -->
        <div class="logo">
            <img src="images/logo.svg" alt="Katen" />
        </div>

        <!-- menu -->
        <nav>
            <ul class="vertical-menu">
                <li class="active">
                    <a href="index.html">Home</a>
                </li>

                @if (!Auth::user())
                    <li><a href="{{ route('login') }}">Explore</a></li>
                    <li><a href="{{ route('login') }}">Topics</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="{{ route('register') }}">Get Started </a></li>
                @else
                    <li><a href="#">My Account </a></li>
                    <li><a href="#">Publications</a></li>
                    <li><a href="#">New Article </a></li>
                    <li><a href="#">Logout </a></li>
                @endif
            </ul>
        </nav>

        <!-- social icons -->
        <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
            <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                        class="fab fa-facebook-f"></i></a>
            </li>
            <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                        class="fab fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i class="fab fa-medium"></i></a>
            </li>
            {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
            </li>
        </ul>
    </div>


    <!-- Image menu -->
    <div class="canvas-menu2 d-flex align-items-end flex-column">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>

        <!-- logo -->
        <div class="logo">
            @auth
                @if (Auth::user()->profile_photo != null)
                    <img class=" rounded-circle img-fluid " src="{{ asset('/images/' . Auth::user()->profile_photo) }}"
                        alt="Your avatar" style="height:8rem; width:8rem; object-fit: cover; border:2px solid #ad1deb">
                @else
                    <img class=" rounded-circle img-fluid " src="{{ asset('/images/avartar.png') }}" alt="Your avatar"
                        style="height:5rem; width:4.9rem; object-fit: cover; border:2px solid #ad1deb">
                @endif
            @endauth

        </div>

        <!-- menu -->
        <nav>
            <ul class="vertical-menu2">
                <li class="active">
                    @auth

                        <p>Welcome {{ Auth::user()->name }} !</p>
                    @endauth
                </li>

                @if (!Auth::user())
                    <li><a href="{{ route('login') }}">Explore</a></li>
                    <li><a href="{{ route('login') }}">Topics</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="{{ route('register') }}">Get Started </a></li>
                @else
                    <li><a href="#">My Account </a></li>
                    <li><a href="#">Publications</a></li>
                    <li><a href="#">New Article </a></li>
                    <li><a href="#">Logout </a></li>
                @endif
            </ul>
        </nav>

        <!-- social icons -->
        <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
            <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                        class="fab fa-facebook-f"></i></a>
            </li>
            <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                        class="fab fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i class="fab fa-medium"></i></a>
            </li>
            {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
            </li>
        </ul>
    </div>

    <style>
        .hero img {
            width: 100px;
            height: 100px;
        }
    </style>
@endsection
