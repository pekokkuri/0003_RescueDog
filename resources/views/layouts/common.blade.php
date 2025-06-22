<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Rescue Dog')</title>
    <!-- <link rel="stylesheet" href="{{ url('style.css') }}" /> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])  <!--Tailwind CSS対応-->
</head>
<body>
    <header id="header" class="p-4 bg-gray-100 flex items-center justify-between">
        <h1 class="hover:text-gray-500 text-[30px] ml-[30px]">
            <a href="{{ route('posts.index') }}">RescueDog</a>
        </h1>
        @if (Route::has('login'))
        <nav>
            @auth
                <a href="{{ url('/dashboard') }}" class="mr-4">マイページ</a>
            @else
                <a href="{{ route('login') }}" class="mr-4">ログイン</a>
                <a href="{{ route('register') }}">新規登録</a>
            @endauth

            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="ml-4">ログアウト</button>
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
