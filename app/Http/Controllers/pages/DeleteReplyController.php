<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Reply;

class DeleteReplyController extends Controller
{
    public function deleteReply(Reply $reply) {
        // dd($reply);
        $reply->delete();
        return redirect()->back();
    }
}
