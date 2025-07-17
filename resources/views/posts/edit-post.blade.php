@extends('layouts.common')

@section('title', '編集/RescurDog')

@section('content')

    @include('components.common-form', [
    'formTitle' => '編集フォーム',
    'formMethod' => 'PATCH',
    'formAction' => route('posts.update', $post),
    'submitLabel' => '編集完了',
    'backLink' => route('posts.show', $post),
    ])

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{
            config('services.google_maps.api_key')
        }}"
        async
        defer
    ></script>
    <script src="{{ url('/js/geo.js') }}"></script>
@endsection