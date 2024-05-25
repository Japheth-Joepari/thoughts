<form class="form-control mt-1 d-none" id="reply-{{ $comment->id }}" wire:submit.prevent="addReply">

    <textarea type="text" name="replyBody" class="form-control" value="" style="margin-bottom: 1rem"
        wire:model.defer="replyBody.{{ $comment->id }}"> </textarea>
    @error('replyBody.' . $comment->id)
        <span class="error">{{ $message }}</span>
    @enderror
    <button class="btn btn-success">send</button>
</form>
