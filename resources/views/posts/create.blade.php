<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ url('style.css') }}" />
        <title>RescueDog Create</title>
    </head>
    <body>
        <h1>投稿ページ</h1>
        <form id="post-form" method="POST" action="{{ route('posts.store') }}">
            @csrf
            <!-- <div>
                <label> 画像(仮) </label>
            </div> -->
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
    </body>
</html>
