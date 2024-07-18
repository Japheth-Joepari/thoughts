<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>thoughts</title>
    <meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="images/thotlogo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- STYLES -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />



    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
    @livewireScripts()
    <!-- preloader -->
    <div id="preloader">
        <div class="center">
            <img src="{{ asset('images/l.gif') }}" alt="">
        </div>
    </div>

    @yield('content')
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

                @if (Auth::user())
                    <li><a href="{{ route('explore') }}">Explore</a></li>
                    <li><a href="{{ route('topics') }}">Topics</a></li>
                    <li><a href="{{ route('contact') }}">Connect</a></li>
                    <li
                        onclick="document.getElementById('logout').submit();>Logout </li>
                    <li><a href="{{ route('write') }}">
                        Publish </a></li>
                    <li><a href="{{ route('editProfile', Auth::user()) }}">My Account </a></li>
                @else
                    <li><a href="{{ route('register') }}">Get Started
                        </a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    {{-- <li><a href="{{ route('author'), Auth::user() }}">Publications</a></li> --}}
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

    @if (Auth::user())
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

            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none">
                @csrf
                <!-- form fields go here -->
            </form>

            <!-- menu -->
            <nav>
                <ul class="vertical-menu2">
                    <li class="active">
                        @auth

                            <p>Welcome {{ Auth::user()->name }} !</p>
                        @endauth
                    </li>
                    <li><a href="{{ route('editProfile', Auth::user()) }}">Edit Profile </a></li>
                    <li><a href="{{ route('author', Auth::user()) }}">Publications</a></li>
                    <li><a href="{{ route('write') }}">New Article </a></li>
                    <li onclick="document.getElementById('logout').submit();"><a href="#">Logout </a></li>
                </ul>

            </nav>


            <!-- social icons -->
            <ul class="social-icons
                            list-unstyled list-inline mb-0 mt-auto w-100">
                <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                            class="fab fa-facebook-f"></i></a>
                </li>
                <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                            class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                            class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                            class="fab fa-medium"></i></a>
                </li>
                {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                </li>
            </ul>
        </div>
    @endif
    <!-- JAVA SCRIPTS -->
    <script defer src="{{ asset('js/jquery.min.js') }}"></script>
    <script defer src="{{ asset('js/popper.min.js') }}"></script>
    <script defer src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('js/slick.min.js') }}"></script>
    <script defer src="{{ asset('js/jquery.sticky-sidebar.min.js') }}"></script>
    <script defer src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
