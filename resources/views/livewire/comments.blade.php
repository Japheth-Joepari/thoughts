<div>
    <ul class="comments">
        @foreach ($comments as $comment)
            <li class="comment rounded" wire:key="comment-{{ $comment->id }}">
                <div class="thumb">
                    <img src="{{ asset('images/avartar.png') }}" alt="John Doe" style="height: 7vh" />
                </div>
                <div class="details">
                    <h4 class="name"><a href="blog-single-alt.html#">{{ $comment->user->name }}</a></h4>
                    <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                    <p>{{ $comment->body }}</p>

                    <div class="d-flex" style="gap: 0.3rem">
                        <div class="">
                            @if ($comment->user_id === Auth::id())
                                <button wire:click="deleteComment({{ $comment->id }})"
                                    class="btn btn-danger">Delete</button>
                            @endif
                        </div>
                        {{-- <div class="" style="gap: 9rem"></div> --}}
                        <div>

                            <button class="btn btn-default btn-sm" id="reply-button-{{ $comment->id }}"
                                onclick="toggleReplyInput({{ $comment->id }})">Reply</button>
                            <form class="form-control mt-1 d-none" id="reply-{{ $comment->id }}">

                                <input type="text" class="form-control" value="" style="margin-bottom: 1rem"
                                    wire:model.defer="replyBody.{{ $comment->id }}">
                                @error('replyBody.' . $comment->id)
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <button class="btn btn-success">send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

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
            <button type="submit" class="btn btn-default">Reply</button>
        </form>
    </div>
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
</script>
