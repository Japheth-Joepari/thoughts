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
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('explore') }} ">Explore</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('topics') }}">Topics</a>
                            </li>

                            @if (Auth::user())
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('write') }}">Write</a>
                                </li>
                                <li class="nav-item">
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
                                    <button class=" burger-menu2 b2" href="#"
                                        style="background: transparent; border:none; width:3.4rem;">
                                        @if (Auth::user()->profile_photo != null)
                                            <img class=" rounded-circle img-fluid "
                                                src="{{ asset('/images/' . Auth::user()->profile_photo) }}" alt="Your avatar"
                                                style="height:2.5rem; width:2.6rem; object-fit: cover; border:2px solid #ad1deb">
                                        @else
                                            <img class=" rounded-circle img-fluid " src="{{ asset('/images/avartar.png') }}"
                                                alt="Your avatar" style="">
                                        @endif
                                    </button>
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

        <section class="single-cover2  data-bg-image" data-bg-image="{{ asset('images/file.jpg') }}">

            <div class="container-xl">

                <div class="cover-content post">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Account Settings</a>
                            </li>

                        </ol>
                    </nav>

                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3">Edit Profile</h1>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="#">{{ $user->name }}</a></li>
                        </ul>
                        <button id="scroll-button" class="btn btn-light mt-2 scroll-button">Scroll down</button>
                    </div>
                </div>

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

        <div class="container mt-3">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-lg">
                            <div class="card-body" id="target-element">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset('images/' . $user->profile_photo) }}" alt="Admin"
                                        class="rounded-circle p-1 bg-white"
                                        style="width: 20vh; height: 20vh; border: 2px solid gray" id="imagePreview">

                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-secondary mb-1">{{ $user->about }}</p>
                                        <button class="btn btn-danger">Delete account</button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-globe me-2 icon-inline">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="2" y1="12" x2="22" y2="12">
                                                </line>
                                                <path
                                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                                </path>
                                            </svg>Website</h6>
                                        <a href="{{ $user->website }}" class="text-secondary">{{ $user->website }}</a>
                                    </li>

                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-twitter me-2 icon-inline text-info">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                </path>
                                            </svg>Twitter</h6>
                                        <a href="https://twitter.com/{{ $user->twitter }}"
                                            class="text-secondary">{{ $user->twitter }}</a>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-instagram me-2 icon-inline text-danger">
                                                <rect x="2" y="2" width="20" height="20"
                                                    rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5">
                                                </line>
                                            </svg>Instagram</h6>
                                        <a href="https://www.instagram.com/{{ $user->instagram }}/"
                                            class="text-secondary">{{ $user->instagram }}</a>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-facebook me-2 icon-inline text-primary">
                                                <path
                                                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                </path>
                                            </svg>Facebook</h6>
                                        <a href="https://twitter.com/{{ $user->facebook }}"
                                            class="text-secondary">{{ $user->facebook }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <form id="contact-form" class="card-body shadow-lg" method="post"
                                action="{{ route('updateProfile', $user) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('put') --}}

                                <div class="messages"></div>

                                <div class="row">
                                    <div class="column col-md-6">
                                        <!-- Name input -->
                                        <label for="name">Full Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Full Name" value="{{ old('name', $user->name) }}">
                                            @error('name')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <label for="email">Email</label>
                                        <!-- Email input -->
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email address" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <!-- Facebook input -->
                                        <div class="form-group">
                                            <label for="facebook">Facebook </label>
                                            <input type="text" class="form-control" name="facebook" id="facebook"
                                                placeholder="Facebook Username"
                                                value="{{ old('facebook', $user->facebook) }}">
                                            @error('facebook')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <label for="twitter">Twitter </label>
                                        <!-- twitter input -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="twitter" id="twitter"
                                                placeholder="Twitter Username"
                                                value="{{ old('twitter', $user->twitter) }}">
                                            @error('twitter')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <label for="instagram">Instagram </label>
                                        <!-- instagram input -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="instagram" id="instagram"
                                                placeholder="Instagram Username"
                                                value="{{ old('instagram', $user->instagram) }}">
                                            @error('instagram')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <label for="website">Website </label>
                                        <!-- website input -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="website" id="website"
                                                placeholder="Website url" value="{{ old('website', $user->website) }}">
                                            @error('website')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <label for="password">Password </label>
                                        <!-- Password  -->
                                        <div class="form-group">
                                            <input class="form-control" name="password" id="password"
                                                placeholder="Password" data-error="Password is required" type="password">
                                            @error('password')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <label for="confirm-password">Confirm </label>
                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="confirm_password" placeholder="Confirm Password">
                                            @error('confirm_password')
                                                <div class="help-block with-errors"></div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="column col-md-12">
                                        <label for="facebook">Short Bio </label>
                                        <!-- About textarea -->
                                        <div class="form-group">
                                            <textarea name="about" id="about" class="form-control" rows="4" placeholder="Short Bio...">{{ old('about', $user->about) }}</textarea>
                                            @error('about')
                                                <div class="help-block with-errors">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="column col-md-12">
                                    <!-- File input -->
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="profile_photo"
                                            onchange="previewImage(this)" name="profile_photo" />
                                        @error('profile_photo')
                                            <div class="help-block with-errors"></div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" name="submit" id="submit" value="Submit"
                                    class="btn btn-default">Update Profile</button><!-- Send Button -->

                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="d-flex align-items-center mb-3">Contributions</h5>
                                        <p>(9) Posts</p>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <li><a href="">Edit Profile </a></li>
                    <li><a href="{{ route('author', Auth::user()) }}">Publications</a></li>
                    <li><a href="{{ route('write') }}">New Article </a></li>
                    <li><a href="{{ route('logout') }}">Logout </a></li>
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


        // Get a reference to the button and the target element
        const scrollButton = document.getElementById('scroll-button');
        const targetElement = document.getElementById('target-element');

        // Add a click event listener to the button
        scrollButton.addEventListener('click', () => {
            // Use the scrollIntoView method to scroll to the target element
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
@endsection
