<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('index')->with(['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
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
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit-post')->with(['post' =>  $post]);
    }

    public function update(Request $request, Post $post)
    {
        $post->address = $request->address;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard');
    }
}
