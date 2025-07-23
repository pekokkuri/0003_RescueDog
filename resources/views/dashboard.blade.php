@extends('layouts.common')

@section('title', 'マイぺージ/RescueDog')

@section('content')

<div class="p-6 text-gray-900">
    <div class="text-3xl p-4">
        現在の投稿一覧
    </div>

    <ul class="p-4 flex gap-20">
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
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">プロフィールを編集</a>

</div>
@endsection
