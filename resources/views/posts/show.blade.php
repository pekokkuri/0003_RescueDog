@extends('layouts.common')

@section('title', '詳細/RescueDog')

@section('content')

<div class="flex justify-center mt-4">
  <div class="border border-gray-400 rounded p-4 m-4 w-[1000px] h-auto">
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

    <div class="flex justify-between">
      <div class="pt-4 text-xl ml-[30px]">
        @if ($post->status === 1)
          <p class="text-red-500 font-bold">💡ワンちゃんが見つかりました！</p>
        @else
          <p class="text-blue-500 font-bold">🔎ワンちゃんを探しています！</p>
        @endif
      </div>

      <!-----------------
        編集・削除ボタン
      ------------------->
      <div class="flex gap-6 justify-end pt-4">

        <!-- 編集画面へ遷移 -->
        <a href="{{ route('posts.edit-post', ['post' => $post->id]) }}" class="bg-gray-500 hover:bg-gray-400 text-white text-center rounded px-4 py-2">
          投稿を編集する
        </a>

        <!-- 削除 -->
        <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete-form">
          @method('DELETE')
          @csrf
          <button class="bg-red-400 hover:bg-red-300 text-white text-center rounded px-4 py-2">
            投稿を削除する
          </button>
        </form>
      </div>
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

    </div>

      <!-- 「見つかった」ボタン -->
      @if ($post->status === 0)
      <form method="POST" action="{{ route('posts.found', $post) }}">
        @csrf
        <div class="flex justify-end">
          <button class="bg-pink-500 hover:bg-pink-400 text-white text-center rounded px-4 py-2">
              🤍見つかった
          </button>
        </div>
      @endif
      </form>
  </div>
</div>

@endsection