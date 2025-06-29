@extends('layouts.common')

@section('title', '投稿/RescueDog')

@section('content')
    <h1>投稿ページ</h1>
    <form id="post-form" method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div>
            <label>画像
                <input type="file" name="image" alt="画像"/>
            </label>
        </div>
        <div>
            <label>
                場所
                <input type="text" name="address" id="address" />
            </label>

            <input type="hidden" name="lat" id="lat" />
            <input type="hidden" name="lng" id="lng" />

            <div id="error-message"></div>
        </div>
        <!-- <div>
            <label>
                特徴
                <textarea></textarea>
            </label>
        </div> -->
        <div>
            <button type="button" onclick="submitForm()">投稿</button>
        </div>
    </form>

    <a href="{{ route('posts.index') }}">
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
