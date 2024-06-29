@extends('layouts.pageTemplate')
@section('content')
@section('connect-active', 'active')
<!-- site wrapper -->
<div class="site-wrapper">

    <div class="main-overlay"></div>


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
                                <img src="
                                    @if ($user->profile_photo != null) {{ asset($user->profile_photo) }}
                                    @else
                                    {{ asset('images/avartar.png') }} @endif
                                    "
                                    alt="Admin" class="rounded-circle p-1 bg-white"
                                    style="width: 20vh; height: 20vh; border: 2px solid gray" id="imagePreview">

                                <div class="mt-3">
                                    <h4>{{ $user->name }}</h4>
                                    <p class="text-secondary mb-1">{{ $user->about }}</p>
                                    <button class="btn btn-danger">Delete account</button>
                                </div>
                            </div>
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
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

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
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
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram me-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5"
                                                ry="5"></rect>
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
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
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

                            <div class="column col-md-12 p-1">
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

                            <a href="{{ route('author', $user) }}" type="submit" name="submit" id="submit"
                                value="Submit" class="btn btn-success"><i class="fa-solid fa-eye"></i> view
                                Profile</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div><!-- end site wrapper -->

@endsection
