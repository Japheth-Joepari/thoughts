<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>thoughts</title>
    <meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/thotlogo.png') }}">

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
    {{-- live wire --}}
    @livewireScripts()

    <!-- preloader -->
    <div id="preloader">
        <div class="center">
            <img src="{{ asset('images/l.gif') }}" alt="">
        </div>
    </div>

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>
        <!-- header -->
        <header class="header-default   " id="topp">
            <nav class="navbar navbar-expand-lg">
                <div class="container-xl nv">
                    <!-- site logo -->
                    <a class="navbar-brand " href="{{ route('home') }}"><img src="{{ asset('images/thotlogo.png') }}"
                            alt="logo" class="img" /></a>

                    <div class="collapse navbar-collapse">
                        <!-- menus -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown @yield('home-active')">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item @yield('explore-active')">
                                <a class="nav-link" href="{{ route('explore') }}">Explore</a>
                            </li>
                            <li class="nav-item @yield('topics-active')">
                                <a class="nav-link" href="{{ route('topics') }}">Trending</a>
                            </li>
                            <li class="nav-item @yield('connect-active')">
                                <a class="nav-link" href="{{ route('contact') }}">Connect</a>
                            </li>
                            <li class="nav-item dropdown @yield('write-active')">
                                <a class="nav-link" href="{{ route('write') }}">Publish</a>
                            </li>
                            @if (!Auth::user())
                                <li class="nav-item">
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
                            {{-- <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                        class="fab fa-medium"></i></a></li> --}}
                            {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                            </li>
                        </ul>
                        <!-- header buttons -->
                        <div class="header-buttons">



                            <button class="search icon-button">
                                <i class="icon-magnifier"></i>
                            </button>

                            @auth

                                <livewire:unread-notifications />
                            @endauth

                            @if (!Auth::user())
                                <button class="burger-menu icon-button d-xl-none ">
                                    <span class="burger-icon "></span>
                                </button>
                            @endif
                            @if (!Auth::user())
                                <a class="btn btn-primary  starts" href="{{ route('register') }}"
                                    style="background: rgb(0, 0, 0); color:">Get started <i
                                        class="fa-solid fa-right-to-bracket"></i> </a>
                            @else
                                @auth
                                    @if (Auth::user()->profile_photo != null)
                                        <button class=" burger-menu2 " href="#"
                                            style="background: transparent; border:none;">
                                            <img class=" rounded-circle img-fluid icon-button2"
                                                src="{{ Auth::user()->profile_photo }}" alt="Your avatar"
                                                style="border: 3px solid#ad1deb;" loading="lazy">
                                        </button>
                                    @else
                                        <button class=" burger-menu2 " href="#"
                                            style="background-color: transparent; border: transparent">
                                            <img class=" rounded-circle img-fluid icon-button2"
                                                style="border: 3px solid#ad1deb;"
                                                src="{{ asset('/images/avartar.png') }}" alt="Your avatar"
                                                loading="lazy">
                                        </button>
                                    @endif
                                @endauth
                            @endif

                            <form id="myForm" action="{{ route('logout') }}" method="POST"
                                style="display: none">
                                @csrf
                                <!-- form fields go here -->
                            </form>
                            @auth

                                <a class="icon-button b1" href="#"
                                    onclick="document.getElementById('myForm').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        class="" style="height: 1rem" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
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

        <!-- page header -->

        @yield('content')

        <!-- footer -->
        <footer>
            <div class="container-xl ">
                <div class="footer-inner" style="">
                    <div class="row d-flex align-items-center  justify-content-between gy-4">
                        <!-- social icons -->
                        <div class="col-md-4">
                            <ul class="social-icons list-unstyled list-inline mb-0 ">
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

                        <!-- copyright text -->
                        <div class="col-md-4 float-md-start">
                            <span class="copyright">© 2023 Thoughts. Made with &#x1F493; by Japheth Joepari.</span>
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


            <form class="d-flex search-form" action="/search">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search and press enter ..."
                    aria-label="Search" value="{{ request()->input('query') }}" name="query">
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
            <img src="{{ asset('images/thotlogo.png') }}" alt="Katen" />
        </div>

        <!-- menu -->
        <nav>
            <ul class="vertical-menu">
                <li class="" @yield('home-active')>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="" @yield('explore-Active')><a href="{{ route('explore') }}">Explore</a></li>
                <li class="" @yield('topics-active')><a href="{{ route('topics') }}">Trending</a></li>
                <li><a href="{{ route('contact') }}" @yield('topics-active') class="">Connect</a></li>
                <li><a href="{{ route('write') }}">Publish your article </a></li>
                <li><a href="{{ route('register') }}">Get Started
                    </a></li>
                <li><a href="{{ route('login') }}" class="btn btn-primary text-white"><i
                            class="fa-solid fa-right-to-bracket"></i> Login</a></li>
                {{-- <li><a href="{{ route('author'), Auth::user() }}">Publications</a></li> --}}
            </ul>
        </nav>

        <!-- social icons -->
        <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
            <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                        class="fab fa-facebook-f"></i></a>
            </li>
            <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                        class="fab fa-twitter"></i></a>
            </li>
            <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                        class="fab fa-instagram"></i></a></li>
            {{-- <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                        class="fab fa-medium"></i></a> --}}
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
                        <img class=" rounded-circle img-fluid " src="{{ Auth::user()->profile_photo }}"
                            alt="Your avatar" style="height:8rem; width:8rem; object-fit: cover; border:2px solid #ad1deb"
                            loading="lazy">
                    @else
                        <img class=" rounded-circle img-fluid " src="{{ asset('/images/avartar.png') }}"
                            alt="Your avatar" style="height:8rem; width:8rem; object-fit: cover; border:2px solid #ad1deb"
                            loading="lazy">
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
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('explore') }}">Explore</a></li>
                    <li><a href="{{ route('topics') }}">Trending</a></li>
                    <li><a href="{{ route('editProfile', Auth::user()) }}">Account Settings </a></li>
                    <li><a href="{{ route('author', Auth::user()) }}">My Profile</a></li>
                    <li><a href="{{ route('write') }}">New Article </a></li>
                    <li><a href="{{ route('contact') }}">Connect</a></li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <li><button type="submit" class="btn btn-primary">Logout </button></li>
                    </form>
                </ul>
            </nav>


            <!-- social icons -->
            <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
                <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                            class="fab fa-facebook-f"></i></a>
                </li>
                <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                            class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                            class="fab fa-instagram"></i></a></li>
                {{-- <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                            class="fab fa-medium"></i></a> --}}
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
    <script>
        // Get a reference to the button and the target element
        const scrollButton = document.getElementById('scroll-button');
        const targetElement = document.getElementById('sction');

        // Add a click event listener to the button
        scrollButton.addEventListener('click', () => {
            // Use the scrollIntoView method to scroll to the target element
            // console.log('clicked');
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>

    <script>
        // Get the image input and preview elements
        var imageInput = document.getElementById('profile_photo');
        var imagePreview = document.getElementById('imagePreview');

        // Listen for changes to the image input field
        imageInput.addEventListener('change', function(event) {
            // Get the file selected by the user
            var file = event.target.files[0];

            // Create a FileReader object to read the file
            var reader = new FileReader();

            // Set up the function to be called when the FileReader finishes reading the file
            reader.onload = function(event) {
                // Set the source of the image preview to the data URL created by the FileReader
                imagePreview.src = event.target.result;
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);

        });

        document.getElementById("back-to-top").addEventListener("click", function() {
            console.log('clicked')
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    </script>

</body>

</html>
