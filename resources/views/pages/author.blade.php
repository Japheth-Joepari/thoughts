@extends('layouts.pageTemplate')
@section('content')
@section('home-active', '')

<section class="hero data-bg-image d-flex align-items-center"
    @if ($user->profile_photo == '') data-bg-image="{{ asset('images/avartar.png') }}"
        @else
        data-bg-image="{{ asset('images/' . $user->profile_photo) }}" @endif>
    <div class="container-xl" style="border: transparent">
        <!-- call to action -->
        <div class="cta text-center">
            <h2 class="mt-0 mb-4">Hey I'm {{ $user->name }}</h2>
            <p class="mt-0 mb-4">
                @if ($user->about == '')
                    Hello welcome to my page I'm a writer. Feel free to view, read and engage in my content
                @else
                    {{ $user->about }}
                @endif
            </p>
            <ul class="social-icons list-unstyled list-inline mb-0">
                @if ($user->facebook != null)
                    <li class="list-inline-item"><a href="https://www.facebook.com/{{ $user->facebook }}/"><i
                                style="color: white" class="fab fa-facebook-f"></i></a>
                @endif

                @if ($user->twitter != null)
                    <li class="list-inline-item"><a href="https://twitter.com/{{ $user->twitter }}"><i
                                style="color: white" class="fab fa-twitter"></i></a></li>
                @endif

                @if ($user->instagram != null)
                    <li class="list-inline-item"><a href="https://www.instagram.com/{{ $user->instagram }}/"><i
                                style="color: white" class="fab fa-instagram"></i></a></li>
                @endif

                @if ($user->website != null)
                    <li class="list-inline-item"><a href="{{ $user->website }}"><i class="fa-solid fa-link"
                                style="color: white"></i></a></li>
                @endif
                </li>

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
<section class="main-content">
    <div class="container-xl">

        <div class="row gy-4">


            <div class="col-lg-8">

                <div class="row">

                    <div class="padding-30 rounded bordered">
                        <div class="widget-header " id="sction">
                            <h3 class="widget-title">{{ $user->name }} Articles</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                        </div>
                        @if ($user->post->count() > 0)
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
                                                    <img src="{{ $post->image }}" alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details">
                                            <ul class="meta list-inline mb-3">
                                                <li class="list-inline-item"><a
                                                        href="{{ route('author', $post->user) }}"><img
                                                            @if ($post->user->profile_photo == '') src="{{ asset('images/avartar.png') }}"
                                                            @else

                                                            src="{{ asset('/images/' . $user->profile_photo) }}" @endif
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
                        @else
                            <h6 class="text-center" id="sction">{{ $user->name }} has (0) published article</h6>
                        @endif

                        <!-- load more button -->
                        <div class="text-center mb-3">
                            {{ $usersPost->links() }}
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-4 ">


                <!-- sidebar -->
                <div class="sidebar">

                    {{-- <div class="widget-content"> --}}


                    <!-- widget newsletter -->
                    <div
                        class="container d-flex justify-content-center align-items-center shadow mt-4 rounded bordered">

                        <div class="card ">

                            {{-- <div class="upper">

                                <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid  img2">

                            </div> --}}

                            <div class="user text-center">

                                <div class="profile">

                                    @if ($user->profile_photo == null)
                                        <img src="{{ asset('images/avartar.png') }}" class="rounded-circle img1"
                                            style="height:7rem; width:7rem">
                                    @else
                                        <img src="{{ asset('images/' . $user->profile_photo) }}"
                                            class="rounded-circle img1" style="height:7rem; width:7rem">
                                    @endif

                                </div>

                            </div>


                            <div class="text-center">

                                <h4 class="mb-0">{{ $user->name }}</h4>
                                <span class="text-muted d-block mb-2">Author</span>
                                @auth
                                    @if (Auth::user()->id == $user->id)
                                        <a href="{{ route('editProfile', $user) }}"
                                            class="btn btn-primary btn-sm follow">Edit
                                            Profile</a>
                                    @else
                                        <livewire:follow-button :user="$user" :buttonClass="'btn btn-primary btn-sm follow'" />
                                    @endif
                                @endauth



                                <div class="d-flex justify-content-between align-items-center  px-4">

                                    <div class="stats">
                                        <h6 class="mb-0">Followers</h6>
                                        <span>{{ $user->followers->count() }}</span>

                                    </div>


                                    <div class="stats">
                                        <h6 class="mb-0">Following</h6>
                                        <span>{{ $user->following->count() }}</span>

                                    </div>


                                    <div class="stats">
                                        <h6 class="mb-0">Articles</h6>
                                        <span>{{ $user->post->count() }}</span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- </div> --}}

                    <div class="widget-content mt-3">

                        <div class="post-tabs2 rounded bordered shadow">
                            <!-- tab navs -->
                            <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
                                <li class="nav-item" role="presentation"><button aria-controls="popular"
                                        aria-selected="true" class="nav-link active" data-bs-target="#popular"
                                        data-bs-toggle="tab" id="popular-tab" role="tab" type="button">(
                                        {{ $user->followers->count() }} ) Followers</button>
                                </li>
                                <li class="nav-item" role="presentation"><button aria-controls="recent"
                                        aria-selected="false" class="nav-link" data-bs-target="#recent"
                                        data-bs-toggle="tab" id="recent-tab" role="tab" type="button">
                                        ({{ $user->following->count() }})
                                        Following</button></li>
                            </ul>
                            <!-- tab contents -->
                            <div class="tab-content" id="postsTabContent">
                                <!-- loader -->
                                <div class="lds-dual-ring"></div>
                                <!-- popular posts -->
                                <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular"
                                    role="tabpanel">
                                    <!-- post -->
                                    @if ($user->followers != '')
                                        @foreach ($followers as $user)
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <a href="{{ route('author', $user) }}">
                                                        <div class="inner">
                                                            @if ($user->profile_photo == null)
                                                                <img src="{{ asset('images/avartar.png') }}"
                                                                    alt="post-title"
                                                                    style="object-fit: cover; height:3.6rem;" />
                                                            @else
                                                                <img src="{{ asset('images/' . $user->profile_photo) }}"
                                                                    alt="post-title"
                                                                    style="object-fit: cover; height:3.6rem;" />
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0"><a
                                                            href="{{ route('author', $user) }}">{{ $user->name }}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">
                                                            joined{{ $user->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">(0) active followers</p>
                                    @endif
                                    @if ($followers->hasPages() && $followers->hasMorePages())
                                        <div style="">
                                            {{ $followers->links() }}
                                        </div>
                                    @endif
                                </div>
                                <!-- recent posts -->
                                <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent"
                                    role="tabpanel">
                                    <!-- post -->
                                    @if ($user->following != '' && $user->following->count() > 0)
                                        @foreach ($followings as $user)
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <a href="{{ route('author', $user) }}">
                                                        <div class="inner">
                                                            @if ($user->profile_photo == null)
                                                                <img src="{{ asset('images/avartar.png') }}"
                                                                    alt="post-title"
                                                                    style="object-fit: cover; height:3.6rem;" />
                                                            @else
                                                                <img src="{{ asset('images/' . $user->profile_photo) }}"
                                                                    alt="post-title"
                                                                    style="object-fit: cover; height:3.6rem;" />
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0"><a
                                                            href="{{ route('author', $user) }}">{{ $user->name }}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">
                                                            joined{{ $user->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">(0) active following..</p>
                                    @endif
                                    @if ($followings->hasPages() && $followings->hasMorePages())
                                        <div style="margin-bottom: 6rem;">
                                            {{ $followings->links() }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- widget popular posts -->


                </div>

            </div>

        </div>

    </div>
    <div class="spacer" data-height="70"></div>
</section>



@endsection
