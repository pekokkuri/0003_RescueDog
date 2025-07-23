@extends('layouts.common')

@section('title', 'パスワード再設定/RescueDog')

@section('content')
<div class="flex">
    <img src="/images/forgot-password.png" class="w-[400px] ml-[150px] mt-4">

        <div class="w-[400px] m-20 ml-auto mr-[200px]">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('パスワードをお忘れですか？') }}
        </div>


        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('登録されているメールアドレスを入力してください')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />


            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    戻る
                </a>
                <x-primary-button>
                    {{ __('送信') }}
                </x-primary-button>

            </div>
        </form>
    </div>
@endsection