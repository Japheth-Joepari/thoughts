<div class="col-lg-4">

    <!-- post tabs -->
    <div class="post-tabs rounded bordered">
        <!-- tab navs -->
        <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
            <li class="nav-item" role="presentation"><button aria-controls="popular" aria-selected="true"
                    class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab"
                    role="tab" type="button">Popular</button></li>
            <li class="nav-item" role="presentation"><button aria-controls="recent" aria-selected="false"
                    class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab"
                    type="button">Recent</button></li>
        </ul>
        <!-- tab contents -->
        <div class="tab-content" id="postsTabContent">
            <!-- loader -->
            <div class="lds-dual-ring"></div>
            <!-- popular posts -->
            <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular" role="tabpanel">
                <!-- post -->
                @foreach ($mostPopularAsc as $post)
                    <div class="post post-list-sm circle">
                        <div class="thumb circle">
                            <a href="blog-single.html">
                                <div class="inner">
                                    <img src="{{ asset('images/' . $post->image) }}" alt="post-title"
                                        style="object-fit: cover; height:3.6rem;" />
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a href="blog-single.html">{{ $post->name }}</a></h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">
                                    {{ $post->created_at->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- recent posts -->
            <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
                <!-- post -->
                @foreach ($latestPosts as $post)
                    <div class="post post-list-sm circle">
                        <div class="thumb circle">
                            <a href="blog-single.html">
                                <div class="inner">
                                    <img src="{{ asset('images/' . $post->image) }}" alt="post-title"
                                        style="object-fit: cover; height:3.6rem;" />
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a href="blog-single.html">{{ $post->name }}</a></h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">
                                    {{ $post->created_at->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    @yield('popularRecent')
</div>
