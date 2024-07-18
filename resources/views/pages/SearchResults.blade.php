@extends('layouts.pageTemplate')
@section('content')
    <div class="content">
        <section class="single-cover2  data-bg-image" data-bg-image="{{ url('images/banner.webp') }}">

            <div class="container-xl">

                <div class="col-lg-12" style="position: relative; z-index: 1;">
                    <div class="search-result-box card-box">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="pt-5">
                                    <div class="input-group">
                                        <form class="form-control d-flex" style="border:none; background: transparent;"
                                            action="/search">
                                            @csrf
                                            <input class="form-control " type="search"
                                                placeholder=" Search and press enter ..." name="query" aria-label="Search"
                                                value="{{ request()->input('query') }}">
                                            <button class="btn btn-default btn-sm" type="submit"><i
                                                    class="icon-magnifier"></i></button>
                                        </form>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <h4 class="text-white">Search Page</h4>
                                        <div class="d-flex justify-content-center">
                                            <button id="scroll-button" class="btn btn-light mt-2">Scroll down</button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                </div>
            </div>

            <span class="mouse2" style="margin-top: 4rem;">
                <span class="wheel2"></span>
            </span>

        </section>

        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">

                        <!-- section header -->



                        <div class="spacer" data-height="30"></div>


                        <!-- section header -->
                        <div class="section-header" id="target-element">
                            <h3 class="section-title">Results for "{{ $searchQuery }}"</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                        </div>

                        @if ($posts->count() > 0)
                            <div class="padding-30 rounded bordered">

                                <div class="row">

                                    <div class="col-md-12 col-sm-6 shadow-sm">
                                        <!-- post -->
                                        @foreach ($posts as $post)
                                            <div class="post post-list clearfix" id="sction">
                                                <div class="thumb rounded">
                                                    <span class="post-format-sm">
                                                        <i class="icon-picture"></i>
                                                    </span>
                                                    <a href="{{ route('viewArticle', $post) }}">
                                                        <div class="inner">
                                                            <img src="{{ $post->image }}" alt="post-title"
                                                                loading="lazy" />
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
                                    <!-- paginate will appear here -->
                                </div>

                            </div>
                        @else
                            <h6 class="text-center mt-5">No results found for "{{ $searchQuery }}"</h6>
                        @endif


                    </div>
                    <div class="col-lg-4">

                        <!-- sidebar -->
                        <div class="sidebar mt-4">
                            <!-- widget about -->


                            <!-- widget newsletter -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Newsletter</h3>
                                    <img src="images/wave.svg" class="wave" alt="wave" />
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
                                            href="personal.html#">Privacy Policy</a></span>
                                </div>
                            </div>



                        </div>

                    </div>
        </section>

    </div>
    <!-- container -->
    </div>
@endSection
