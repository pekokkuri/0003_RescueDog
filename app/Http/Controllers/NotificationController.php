<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
  public function is_read(Notification $notification) {
    $notification->is_read = true;
    $notification->read_at = now();
    $notification->save();

    if ($notification->type === 'comment' && $notification->comment) {
      return redirect()->route('posts.show', $notification->comment->post_id);
    } elseif ($notification->type === 'reply' && $notification->reply) {
      return redirect()->route('posts.show', $notification->reply->comment->post_id);
    }
  }
}  
