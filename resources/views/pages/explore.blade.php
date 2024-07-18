@extends('layouts.pageTemplate')
@section('explore-active', 'active')
{{-- @section('explore-Active', 'active') --}}
@section('content')
    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>


        <section class="page-header">
            <div class="container-xl">
                <div class="text-center">
                    <h1 class="mt-0 mb-2">Explore Articles</h1>
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
                @if ($editorPicks != '')
                    @foreach ($editorPicks as $post)
                        <div class="post featured-post-md">
                            <div class="details clearfix">
                                <a href="{{ route('categoryPost', $post->category) }}"
                                    class="category-badge">{{ $post->category->name }}</a>
                                <h4 class="post-title"><a href="{{ route('viewArticle', $post) }}">{{ $post->name }}</a>
                                </h4>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a
                                            href="{{ route('author', $post->user) }}">{{ $post->user->name }}</a></li>
                                    <li class="list-inline-item">{{ $post->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                            <a href="{{ route('author', $post->user) }}">
                                <div class="thumb rounded">
                                    <div class="inner data-bg-image" data-bg-image="{{ asset('images/' . $post->image) }}">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">

                        <p class=" mt-5">You have Editor picks...</p>
                        <p class="">Try picking some posts...</p>
                    </div>
                @endif
                <!-- post -->


                <!-- post -->


            </div>
        </section>
        <!-- instagram feed -->
        <div class="instagram">
            <div class="container-xl">
                <!-- button -->
                <a href="https://www.instagram.com/japheth_joepari/" class="btn btn-default btn-instagram">@Thoughts on
                    Instagram</a>
                <!-- images -->
                <div class="instagram-feed d-flex flex-wrap">
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="https://www.instagram.com/japheth_joepari/">
                            <img src="images/insta/insta-1.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="https://www.instagram.com/japheth_joepari/">
                            <img src="images/insta/insta-2.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="https://www.instagram.com/japheth_joepari/">
                            <img src="images/insta/insta-3.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="https://www.instagram.com/japheth_joepari/">
                            <img src="images/insta/insta-4.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="https://www.instagram.com/japheth_joepari/">
                            <img src="images/insta/insta-5.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="https://www.instagram.com/japheth_joepari/">
                            <img src="images/insta/insta-6.jpg" alt="insta-title" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
