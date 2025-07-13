@extends('layouts.common')

@section('title', '詳細/RescueDog')

@section('content')

<div class="flex justify-center mt-4">
  <div class="border border-gray-400 rounded p-4 m-4 w-[1000px] h-dvh">
    <!-----------------
      マップ表示
    ------------------->
    <div id="map" class="h-[250px] mt-4"></div>

    <script>
      const post = @json($post);
    </script>
    <script src="{{ url('/js/show.map.js') }}"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google_maps.api_key') }}&callback=initMap"
      async defer
    ></script>

    <!-----------------
      ボタン
    ------------------->
    <div class="flex gap-4 justify-end pt-4">

      <!-- 編集画面へ遷移 -->
      <a href="{{ route('posts.edit-post', ['post' => $post->id]) }}" class="bg-blue-800 hover:bg-blue-700 text-white text-center rounded px-4 py-2">
        投稿を編集する
      </a>

      <!-- 削除 -->
      <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete-form">
        @method('DELETE')
        @csrf
        <button class="bg-red-800 hover:bg-red-700 text-white text-center rounded px-4 py-2">
          投稿を削除する
        </button>
      </form>
    </div>

    <!-----------------
        投稿内容を表示
    ------------------->
    <div class="flex m-8">
      
        <!-- 投稿画像を表示 -->
        @if ($post->image_path)
          <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="h-[300px] w-[300px]">
        @else
          <img src="/images/NoImage.png" alt="投稿された画像はありません" class="h-[300px] w-[300px]">
        @endif

        <div class="ml-6">
          <label>
            場所：{!! nl2br(e(Str::contains($post->address, '付近') ? $post->address : $post->address . '付近')) !!}
          </label>
        </div>

        <!-- <p><a href="{{ route('dashboard') }}">マイページへ戻る</a></p> -->
    </div>
</div>
</div>
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