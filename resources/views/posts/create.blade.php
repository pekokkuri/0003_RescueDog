@extends('layouts.common')

@section('title', '投稿/RescueDog')

@section('content')
    
<x-common-form
    formTitle="投稿フォーム"
    formMethod="POST"
    :formAction="route('posts.store')"
    submitLabel="投稿する"
    :backLink="route('posts.index')"
>

    <div class="m-4">
        <label class="block">画像：</label>
        <input type="file" name="image" alt="画像" />
    </div>
</x-common-form>

@endsection
