@extends('layouts.common')

@section('title', '編集/RescurDog')

@section('content')
    <h1>編集ページ</h1>
    <form id="post-form" method="POST" action="{{ route('posts.update', $post) }}">
        @method('PATCH')
        @csrf
        <!-- <div>
            <label> 画像(仮) </label>
        </div> -->
        <div>
            <label>
                場所
                <input type="text" name="address" id="address" value="{{ old('address', $post->address) }}"/>
            </label>

            <input type="hidden" name="lat" id="lat" value="{{ old('lat', $post->lat) }}"/>
            <input type="hidden" name="lng" id="lng" value="{{ old('lng', $post->lng) }}"/>

            <div id="error-message"></div>
        </div>
        <!-- <div>
            <label>
                特徴
                <textarea></textarea>
            </label>
        </div> -->
        <div>
            <button type="button" onclick="submitForm()">編集完了</button>
        </div>
    </form>

    <a href="{{ route('posts.show', $post) }}">
        <button>戻る</button>
    </a>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{
            config('services.google_maps.api_key')
        }}"
        async
        defer
    ></script>
    <script src="{{ url('/js/geo.js') }}"></script>
@endsection