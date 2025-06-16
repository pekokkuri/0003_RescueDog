@extends('layouts.common')

@section('title', 'TOP/RescueDog')

@section('content')
    <div class="mt-">
        1匹でも多くのワンちゃんを救いましょう！ ご投稿お待ちしています。
    </div>
    <div id="map" class="h-96 max-w mt-4"></div>

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

    <a href="{{ route('posts.create') }}">
        <button>
            投稿する
        </button>
    </a>
@endsection
