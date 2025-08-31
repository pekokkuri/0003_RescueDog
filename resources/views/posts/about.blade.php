@extends('layouts.common')

@section('title', 'About/RescueDog')

@section('content')

<div class="relative w-auto h-[500px] overflow-hidden flex items-center justify-center">
  <!-- 背景画像 -->
  <img src="/images/about-main.png" 
    class="h-full w-auto object-contain opacity-40 blur-sm"/>

  <!-- テキストを前面に表示 -->
  <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center">
    <p class="text-3xl md:text-4xl font-bold drop-shadow-lg">
      迷子のワンちゃんは見かけませんでしたか？
    </p>
    <p class="p-4 text-xl">
      あなたの『一声』で救える命があります
    </p>
  </div>
</div>

<div class="flex justify-center">
  <a href="{{ route('posts.index') }}"
    class="bg-blue-400 hover:bg-blue-300 text-white text-center rounded px-4 py-2">
    RescueDogを使ってみる
  </a>
</div>

@endsection