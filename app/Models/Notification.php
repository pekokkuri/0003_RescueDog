<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'comment_id',
        'reply_id',
        'is_read',
        'read_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

}
