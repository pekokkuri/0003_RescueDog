<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ url('style.css') }}" />
        <title>Rescue Dog</title>
    </head>
    <body>
        <header id="header">
        <h1>迷子犬マップ</h1>
            @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">マイページ</a>
                @else
                    <a href="{{ route('login') }}">ログイン</a>
                    <a href="{{ route('register') }}">新規登録</a>
                @endauth

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <button type="submit">ログアウト</button>
                    </form>
                @endauth
            </nav>
            @endif
        </header>

        <div id="map"></div>

        <script>
            // コントローラで取得したデータ($posts)をJavascriptでも扱えるようにJSON形式で定義
            const posts = @json($posts);
        </script>
        <script src="{{ url('/js/map.js') }}"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{
                config('services.google_maps.api_key')
            }}&callback=initMap"
            async
            defer
        ></script>
        
        @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
        @endif
        
        <a href="{{ route('posts.create') }}">
            <button>投稿する</button>
        </a>
    </body>
</html>
