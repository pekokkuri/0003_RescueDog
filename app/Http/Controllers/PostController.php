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

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // 投稿画像をstorage/imagesに保存（自動でユニークな名前を割り当てる）
            $path = $request->file('image')->store('images', 'public');
            $post->image_path = $path;
        
        } else {
            $post->image_path = null;
        }

        $post->address = $request->address;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->user_id = auth()->id();
        $post->status = 0;
        $post->save();

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {   
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->with('error', 'ログインが必要です。');
        }

        return view('posts.edit-post')->with(['post' =>  $post]);
    }

    public function update(Request $request, Post $post)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // 投稿画像をstorage/imagesに保存（自動でユニークな名前を割り当てる）
            $path = $request->file('image')->store('images', 'public');
            $post->image_path = $path;
        
        } else {
            $post->image_path = null;
        }

        $post->address = $request->address;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->with('error', 'ログインが必要です。');
        }

        $post->delete();

        return redirect()->route('dashboard');
    }

    public function found(Post $post)
    {   
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->with('error', 'ログインが必要です。');
        }

        $post->status = 1;
        $post->save();

        return redirect()->route('posts.show', $post);
    }
}
