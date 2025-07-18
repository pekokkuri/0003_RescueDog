@extends('layouts.common')

@section('title', 'ログイン/RescueDog')

@section('content')
<!-- Session Status -->

<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="flex">
    <img src="/images/login.image.png" class="w-[500px] m-20">

    <div class="w-[400px] m-20 ml-auto mr-[200px]">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('パスワード')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('次回から自動でログイン') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('パスワードをお忘れの方はこちら') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('ログイン') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

    <!-- <div class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <a href="{{ route('posts.index') }}">戻る</a>
    </div> -->
@endsection
