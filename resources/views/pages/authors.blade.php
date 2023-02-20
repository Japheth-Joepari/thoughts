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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('explore') }}">Explore</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('topics') }}">Topics</a>
                            </li>

                            @if (Auth::user())
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('write') }}">Write</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('authors') }}">Authors</a>
                                </li>
                            @else
                                <li>
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

        <section class="page-header">
            <div class="container-xl">
                <div class="text-center">
                    <h1 class="mt-0 mb-2">Explore Authors</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item"><a href="contact.html#">&#128072; Swipe to view more &#128073;</a>
                            </li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">writers</li> -->
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section class="hero-carousel carl">

            <div class="row post-carousel-featured post-carousel">

                <!-- post -->
                @foreach ($users as $user)
                    <div class="post featured-post-md">
                        <div class="details clearfix">
                            <h4 class="post-title"><a href="{{ route('author', $user) }}">{{ $user->name }}</a>
                            </h4>
                            <a href="{{ route('author', $user) }}" class="category-badge">View Profile</a>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item"><a href="personal.html#">Joined</a></li>
                                <li class="list-inline-item">{{ $user->created_at->diffForHumans() }}</li>
                            </ul>
                        </div>
                        <a href="{{ route('author', $user) }}">
                            <div class="thumb rounded">
                                @if ($user->profile_photo != null)
                                    <div class="inner data-bg-image"
                                        data-bg-image="{{ asset('images/' . $user->profile_photo) }}">
                                    </div>
                                @else
                                    <div class="inner data-bg-image" data-bg-image="{{ asset('images/avartar.png') }}">
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach

                <!-- post -->


            </div>
        </section>
        <!-- instagram feed -->
        <div class="instagram">
            <div class="container-xl">
                <!-- button -->
                <a href="index.html#" class="btn btn-default btn-instagram">@Thoughts on Medium</a>
                <!-- images -->
                <div class="instagram-feed d-flex flex-wrap">
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="index.html#">
                            <img src="images/insta/insta-1.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="index.html#">
                            <img src="images/insta/insta-2.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="index.html#">
                            <img src="images/insta/insta-3.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="index.html#">
                            <img src="images/insta/insta-4.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="index.html#">
                            <img src="images/insta/insta-5.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="index.html#">
                            <img src="images/insta/insta-6.jpg" alt="insta-title" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
@endsection
