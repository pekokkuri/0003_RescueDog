<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('index')->with(['posts' => $posts]);
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('posts.index')->with('error', 'ログインが必要です。');
        }

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->address = $request->address;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->save();

        return redirect()->route('posts.index');
    }
}
