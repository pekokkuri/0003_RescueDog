@extends('layouts.common')

@section('title', 'TOP/RescueDog')

@section('content')
    <div class="mt-4">
        1匹でも多くのワンちゃんを救いましょう！ ご投稿お待ちしています。
    </div>
    <div id="map" class="h-[500px] mt-4"></div>

    <script>
        const posts = @json($posts);
    </script>
    <script src="{{ url('/js/map.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google_maps.api_key') }}&callback=initMap"
        async defer
    ></script>

    @if(session('error'))
        <script>alert("{{ session('error') }}");</script>
    @endif

    <div class="flex justify-center mt-4">
        <a href="{{ route('posts.create') }}"
        class="bg-blue-800 hover:bg-blue-700 text-white text-center rounded px-4 py-2">
            投稿する
        </a>
    </div>
@endsection
