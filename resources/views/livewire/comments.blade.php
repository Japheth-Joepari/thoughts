<div>
    <ul class="comments">
        @foreach ($comments as $comment)
            <li class="comment rounded" wire:key="comment-{{ $comment->id }}">
                <div class="thumb">
                    @if ($comment->user->profile_photo == null)
                        <img src="{{ asset('images/avartar.png') }}" alt="John Doe"
                            style="height: 7vh; border-radius: 50%" />
                    @else
                        <img src="{{ asset('images/' . $comment->user->profile_photo) }}" alt="John Doe"
                            style="height: 3.5rem; border-radius: 50%; width:3.5rem" />
                    @endif
                </div>
                <div class="details">
                    <h4 class="name"><a href="{{ route('author', $comment->user) }}">{{ $comment->user->name }}</a>
                    </h4>
                    <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                    <p>{{ $comment->body }}</p>

                    <div class="d-flex" style="gap: 0.3rem">
                        <div class="">
                            @if ($comment->user_id === Auth::id())
                                <button wire:click="deleteComment({{ $comment->id }})" class="btn btn-danger"> <i
                                        class="fa fa-trash"></i></button>
                            @endif
                        </div>
                        <!-- {{-- <div class="" style="gap: 9rem"></div> --}} -->
                        <div>

                            @auth
                                <button class="btn btn-default btn-sm" id="reply-button-{{ $comment->id }}"
                                    onclick="toggleReplyInput({{ $comment->id }})">Reply</button>
                            @endauth

                            @if (!$comment->replies->isEmpty())
                                <button class="btn btn-primary btn-sm" id="toggle-rep-{{ $comment->id }}"
                                    onclick="toggleReplies({{ $comment->id }})"><i
                                        class="fa-regular fa-comment-dots"></i>
                                    ({{ $comment->replies->count() }})</button>
                            @endif

                        </div>
                    </div>
                </div>
                <form class="form-control mt-1 d-none" id="reply-{{ $comment->id }}"
                    wire:submit.prevent="addReply({{ $comment }})">

                    <div class="col">
                        <textarea name="replyBody" id="body" class="form-control" rows="4" placeholder="Your comment here..."
                            required="required" wire:model.defer="replyBody"></textarea>
                        @error('replyBody')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-success">Send <i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </li>

            @foreach ($comment->replies as $reply)
                <li class="comment child rounded d-none" id="toggleReplies-{{ $comment->id }}">
                    <div class="thumb">
                        @if ($reply->user->profile_photo == null)
                            <img src="{{ asset('images/avartar.png') }}" alt="John Doe"
                                style="height: 7vh; border: 2px solid" class="shadow-lg" />
                        @else
                            <img src="{{ asset('images/' . $reply->user->profile_photo) }}" alt="John Doe"
                                style="height: 7vh; border: 2px solid" class="shadow-lg; " />
                        @endif
                    </div>
                    <div class="details">
                        <h4 class="name"><a href="{{ route('author', $reply->user) }}">{{ $reply->user->name }}</a>
                        </h4>
                        <span class="date">{{ $reply->created_at->diffForHumans() }}</span>
                        <p>{{ $reply->replyBody }}</p>
                        @if ($reply->user_id === Auth::id())
                            <form action="{{ route('deleteReply', $reply) }}" method="post">
                                @csrf
                                <button type="submit" {{-- wire:click="deleteReply({{ $reply->id }})"  --}} class="btn btn-danger"> <i
                                        class="fa fa-trash"></i>
                                </button>
                            </form>
                        @endif
                        <!-- <a href="blog-single-alt.html#" class="btn btn-danger btn-sm">Delete</a> -->
                    </div>
                </li>
            @endforeach
        @endforeach
        <div style="margin-bottom: 4rem">
            {{ $comments->links() }}
        </div>
    </ul>

    @if (!Auth::user())
        <p>Login to be able to sumit a reply
            <a class="btn btn-dark" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> login</a>
        </p>
    @else
        <div class="comment-form rounded bordered padding-30" style="margin-top: 3rem">
            <div class="section-header">
                <h3 class="section-title">Leave a reply</h3>
                <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
            </div>

            <form wire:submit.prevent="addComment">
                @csrf
                <div class="messages"></div>
                <div class="row">
                    <div class="column col-md-12">
                        <!-- Comment textarea -->
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" rows="4" placeholder="Your comment here..."
                                required="required" wire:model.defer="body"></textarea>
                            @error('body')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default"><i class="fa-solid fa-paper-plane"></i> Reply</button>
            </form>
        </div>
    @endif

</div>

<script>
    function toggleReplyInput(commentId) {
        var replyButton = document.getElementById("reply-button-" + commentId);
        var replyInput = document.getElementById("reply-" + commentId);
        if (replyInput.classList.contains("d-none")) {
            replyInput.classList.remove("d-none");
            replyButton.innerHTML = "Cancel";
        } else {
            replyInput.classList.add("d-none");
            replyButton.innerHTML = "Reply";
        }
    }

    // function toggleReplies() {
    //     const replyIds = document.querySelectorAll('[id^="toggleReplies-"]');
    //     replyIds.forEach(replyId => {
    //         const reply = document.getElementById(replyId.id);
    //         reply.classList.toggle('d-none');
    //     });
    // }
    function toggleReplies(commentId) {
        const button = document.getElementById(`toggle-rep-${commentId}`);
        console.log('button:', button);

        const replies = document.querySelectorAll(`#toggleReplies-${commentId}`);
        console.log('replies:', replies);

        replies.forEach(reply => {
            reply.classList.toggle('d-none');
        });

        // ...
    }
</script>
