<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request, Comment $comment)
    {
        $reply = new Reply();
        $reply->comment_id = $comment->id;
        $reply->user_id = auth()->id();
        $reply->body = $request->body;
        $reply->save();

        return back()->with('flashSuccess', 'コメントに返信しました');
    }
}
