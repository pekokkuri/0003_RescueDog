<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("マイページ") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    ようこそ、{{ Auth::user()->name }} さん
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="p-6 text-gray-900">
    <p>現在の投稿一覧：</p>

    <ul>
        @forelse ($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}" class="text-skyblue-100 underline hover:text-blue-100">
                {{ $post->address }}
            </a>
        </li>
        @empty
        <li>まだ投稿していません</li>
        @endforelse
    </ul>
</div>
