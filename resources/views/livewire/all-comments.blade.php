 <ul class="comments">
     {{-- @foreach ($comments as $comment)
         <li class="comment rounded" wire:key="comment-{{ $comment->id }}">
             <div class="thumb">
                 <img src="{{ asset('images/avartar.png') }}" alt="John Doe" style="height: 7vh" />
             </div>
             <div class="details">
                 <h4 class="name"><a href="blog-single-alt.html#">{{ $comment->user->name }}</a></h4>
                 <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                 <p>{{ $comment->body }}</p>
                 <<form action="#">
                     <button class="btn btn-default btn-sm" id="reply-button" type="submit">Reply</button>
                     <input type="text" class="form-control mt-1 d-none" value="" id="reply">
                     </form>
             </div>
         </li>
     @endforeach --}}


 </ul>
