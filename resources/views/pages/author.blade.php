@extends('layouts.pageTemplate')
@section('content')
@section('home-active', '')

<section class="hero data-bg-image d-flex align-items-center"
    data-bg-image="{{ asset('images/' . $user->profile_photo) }}">
    <div class="container-xl" style="border: transparent">
        <!-- call to action -->
        <div class="cta text-center" id="scroll-button">
            <h2 class="mt-0 mb-4">Hey I'm {{ $user->name }}</h2>
            <p class="mt-0 mb-4">Hello, I’m a content writer who is fascinated by content fashion, celebrity
                and
                lifestyle. She helps clients bring the right content to the right people.</p>
            <ul class="social-icons list-unstyled list-inline mb-0">
                <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i style="color: white"
                            class="fab fa-facebook-f"></i></a>
                </li>
                <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i style="color: white"
                            class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                            style="color: white" class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i style="color: white"
                            class="fab fa-twitter"></i></a></li>
                {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                </li>
            </ul>
            <button id="scroll-button" class="btn btn-light mt-2 ">Scroll down</button>
        </div>
    </div>
    <!-- animated mouse wheel -->
    <span class="mouse">
        <span class="wheel"></span>
    </span>

</section>

<!-- section main content -->
@if ($usersPost->count() > 0)
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="widget-header " id="sction">
                    <h3 class="widget-title">{{ $user->name }} Articles</h3>
                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                </div>
                <div class="col-lg-8">
                    <div class="row">

                        <div class="padding-30 rounded bordered">

                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                @foreach ($usersPost as $post)
                                    <div class="post post-list clearfix">
                                        <div class="thumb rounded">
                                            <span class="post-format-sm">
                                                <i class="icon-picture"></i>
                                            </span>
                                            <a href="{{ route('viewArticle', $post) }}">
                                                <div class="inner">
                                                    <img src="{{ asset('images/' . $post->image) }}" alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details">
                                            <ul class="meta list-inline mb-3">
                                                <li class="list-inline-item"><a
                                                        href="{{ route('author', $post->user) }}"><img
                                                            src="{{ asset('/images/' . $user->profile_photo) }}"
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

                                                @auth
                                                    @if (Auth::user()->uuid == $post->user->uuid)
                                                        <div class="more-button float-start ">
                                                            <form action="{{ route('deleteArticle', $post) }}"
                                                                method="post">
                                                                @csrf

                                                                <button type="submit"
                                                                    style="background: transparent; border:transparent;"><i
                                                                        class="fa fa-trash btn btn-danger text-white"></i></button>
                                                            </form>
                                                        </div>

                                                        <div class="more-button float-start">
                                                            <a href="{{ route('editArticle', $post) }}"><i
                                                                    class="fa fa-pen btn btn-success text-white"></i></a>
                                                        </div>
                                                    @endif
                                                @endauth

                                                <div class="more-button float-start">

                                                    <livewire:clap-button :post="$post" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- load more button -->
                            <div class="text-center" style="margin-bottom: 1.2rem">
                                {{ $usersPost->links() }}
                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-lg-4">


                    <!-- sidebar -->
                    <div class="sidebar">


                        <!-- widget popular posts -->
                        <div class="widget rounded">

                            <div class="widget-content">


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
                                        <span class="newsletter-privacy text-center mt-3">By signing up, you
                                            agree
                                            find to our
                                            <a href="index.html#">Privacy Policy</a></span>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
@else
    <h6 class="text-center" id="sction">{{ $user->name }} has (0) published article</h6>
@endif


@endsection
