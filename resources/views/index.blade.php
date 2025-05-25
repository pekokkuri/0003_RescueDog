<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ url('style.css') }}" />
        <title>Rescue Dog</title>
    </head>
    <body>
        <h1>迷子犬マップ</h1>
        <div id="map"></div>
        <script src="{{ url('/js/map.js') }}"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{
                config('services.google_maps.api_key')
            }}&callback=initMap"
            async
            defer
        ></script>
        <a href="{{ route('posts.create') }}">
            <button>投稿する</button>
        </a>
    </body>
</html>
