@extends('layouts.common')

@section('title', '投稿/RescueDog')

@section('content')
    
    @include('components.common-form', [
        'formTitle' => '投稿フォーム',
        'formMethod' => 'POST',
        'formAction' => route('posts.store'),
        'submitLabel' => '投稿する',
        'backLink' => route('posts.index'),
    ])

@endsection
