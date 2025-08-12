<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;

class CommentController extends Controller
{

    public function comment_store(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        $this->comment_notice_store($comment); // 通知作成を呼び出し

        return back()->with('flashSuccess', 'コメントが投稿されました');
    }

    private function comment_notice_store(Comment $comment)
    {
        // 自分の投稿に自分がコメントした場合は通知しない
        if ($comment->post->user_id === $comment->user_id) {
            return;
        }

        $notification = new Notification();
        $notification->user_id = $comment->post->user_id; // 投稿者へ通知
        $notification->type = 'comment';
        $notification->comment_id = $comment->id;
        $notification->is_read = false;
        $notification->save();
    }

}
