@extends('layouts.common')

@section('title', '投稿/RescueDog')

@section('content')
    <fieldset class="border border-gray-400 rounded px-6 pt-4 pb-6 mb-6 relative border-double rounded-lg">
        <legend class="text-gray-500 text-sm px-2">投稿フォーム</legend>
    
        <form id="post-form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
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
    </fieldset>
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
