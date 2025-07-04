@extends('layouts.common')

@section('title', '詳細/RescueDog')

@section('content')

    <!-- 編集画面へ遷移 -->
    <a href="{{ route('posts.edit-post', ['post' => $post->id]) }}">投稿を編集する</a>

    <!-- 削除 -->
    <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete-form">
      @method('DELETE')
      @csrf
      <button>投稿を削除する</button>
    </form>

    <!-- 投稿画像を表示 -->
    @if ($post->image_path)
      <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="h-[300px] w-[300px]">
    @else
      <p>投稿した画像はありません</p>
    @endif

    
    <p>{!! nl2br(e($post->address)) !!}</p>

    <p><a href="{{ route('dashboard') }}">マイページへ戻る</a></p>
  </body>

  <script>
    'use strict';

      const form = document.querySelector('#delete-form');
      form.addEventListener('submit', (e) => {
        e.preventDefault();

        if (confirm('本当に削除しますか?') === false) {
              return;
        }
        form.submit();
        });
  </script>
@endsection