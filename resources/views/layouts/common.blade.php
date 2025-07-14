<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Rescue Dog')</title>
    <!-- <link rel="stylesheet" href="{{ url('style.css') }}" /> -->

    <!------------------------------------ 
        投稿画像を丸くするための設定
    -------------------------------------->
    <style>
        .gm-style img[src*="/storage/"],
        .gm-style img[src*="/images/"] {
            border-radius: 50% !important;
            object-fit: cover;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])  <!--Tailwind CSS対応-->
</head>
<body>
    <header id="header" class="p-4 bg-gray-100 flex items-center justify-between">
        <h1 class="hover:text-gray-500 text-[30px] ml-[30px]">
            <a href="{{ route('posts.index') }}" class="font-bold text text-5xl">RescueDog</a>
        </h1>
        @if (Route::has('login'))
        <nav>
            @auth
                <a href="{{ url('/dashboard') }}" class="mr-4 hover:text-gray-500">マイページ</a>
            @else
                <a href="{{ route('login') }}" class="mr-4 hover:text-gray-500">ログイン</a>
                <a href="{{ route('register') }}" class="mr-4 hover:text-gray-500">新規登録</a>
            @endauth

            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="mr-4 hover:text-gray-500">ログアウト</button>
                </form>
            @endauth
        </nav>
        @endif
    </header>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
