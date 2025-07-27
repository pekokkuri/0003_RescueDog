@extends('layouts.common')

@section('title', 'マイぺージ/RescueDog')

@section('content')
<div class="bg-white" x-data="{ activeTab: 'myPosts' }">
    <nav class="flex flex-col sm:flex-row">
        <!-- タブ切り替えボタン -->
        <button
            @click="activeTab = 'myPosts'"
            :class="activeTab === 'myPosts' 
            ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' 
            : 'text-gray-500 hover:text-blue-600'"
            class="py-2 px-4 transition duration-300"
        >
            現在の投稿一覧
        </button>

        <button
            :class="activeTab === 'profile' 
            ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' 
            : 'text-gray-500 hover:text-blue-600'"
            class="py-2 px-4 transition duration-300"
            @click="activeTab = 'profile'"
        >
            プロフィール
        </button>
    </nav>

    <!-- 投稿一覧の表示 -->
    <div x-show="activeTab === 'myPosts'" class="p-4">
        <ul class="flex gap-6 flex-wrap">
            @forelse ($posts as $post)
                <li class="hover:opacity-50">
                    <a href="{{ route('posts.show', $post) }}">
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="w-64 h-64 object-cover rounded-md">
                        @else
                            <img src="{{ asset('images/NoImage.png') }}" alt="画像なし" class="w-64 h-64 object-cover rounded-md">
                        @endif
                    </a>
                </li>
            @empty
                <li>まだ投稿していません</li>
            @endforelse
        </ul>
    </div>

    <!-- ユーザープロフィールの表示 -->
    <div x-show="activeTab === 'profile'" class="p-4">
        @include('profile.edit-profile', ['user' => Auth::user()])
    </div>
</div>
@endsection
