<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Notification;

class ReplyController extends Controller
{
    public function reply_store(Request $request, Comment $comment)
    {
        $reply = new Reply();
        $reply->comment_id = $comment->id;
        $reply->user_id = auth()->id();
        $reply->body = $request->body;
        $reply->save();

        $this->reply_notice_store($reply); // 通知作成を呼び出し

        return back()->with('flashSuccess', 'コメントに返信しました');
    }

    private function reply_notice_store(Reply $reply)
    {
        // 自分のコメントに自分が返信した場合は通知しない
        if ($reply->comment->user_id === $reply->user_id) {
            return;
        }

        $notification = new Notification();
        $notification->user_id = $reply->comment->user_id; // コメント者へ通知
        $notification->type = 'reply';
        $notification->reply_id = $reply->id;
        $notification->is_read = false;
        $notification->save();
    }
}

