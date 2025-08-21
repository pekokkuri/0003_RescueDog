<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function about()
    {
        return view('posts.about');
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with(['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('posts.index')->with('flashError', 'ログインが必要です');
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
        $post->features = $request->features;
        $post->save();

        return redirect()->route('posts.index')->with('flashSuccess', '正常に投稿されました');
    }

    public function edit(Post $post)
    {   
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->with('flashError', 'ログインが必要です');
        }

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.show', $post)->with('flashError', '他のユーザーの投稿は編集できません');
        }

        return view('posts.edit-post')->with(['post' =>  $post]);
    }

    public function update(Request $request, Post $post)
    {
        // 画像が更新された場合：保存してパスを更新
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->image_path = $path;
        } else {
        // 画像が更新されなかった場合：元の画像をそのまま使う
        $post->image_path = $request->input('current_image');
        }

        $post->address = $request->address;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->features = $request->features;
        $post->save();

        return redirect()->route('posts.show', $post)->with('flashSuccess', '投稿が更新されました');
    }

    public function destroy(Post $post)
    {
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->with('flashError', 'ログインが必要です');
        }

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.show', $post)->with('flashError', '他のユーザーの投稿は削除できません');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('flashSuccess', '投稿が削除されました');
    }

    public function found(Post $post)
    {   
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->with('flashError', 'ログインが必要です');
        }

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.show', $post)->with('flashError', '他のユーザーの投稿は編集できません');
        }
        
        $post->status = 1;
        $post->save();

        return redirect()->route('posts.show', $post);
    }
}
