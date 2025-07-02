@extends('layouts.common')

@section('title', '投稿/RescueDog')

@section('content')
    <h1>投稿ページ</h1>
    <form id="post-form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" 
        class="my-4 border-2 border-gray-400 border-double rounded-lg">
        @csrf
        <div class="m-4">
            <label>画像：
                <input type="file" name="image" alt="画像"/>
            </label>
        </div>
        <div class="m-4">
            <label>
                場所：
                <input type="text" name="address" id="address" class="w-[500px] h-[30px]"/>
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
        <div class="m-4 flex justify-end">
            <button type="button" onclick="submitForm()" class="bg-blue-800 hover:bg-blue-700 text-white text-center rounded px-4 py-2">
                投稿
            </button>
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
