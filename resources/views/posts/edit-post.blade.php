@extends('layouts.common')

@section('title', '編集/RescurDog')

@section('content')

<x-common-form
    formTitle="編集フォーム"
    formMethod="PATCH"
    :formAction="route('posts.update', $post)"
    submitLabel="編集完了"
    :backLink="route('posts.show', $post)"
>

    <div class="m-4">
        <label class="block">画像：</label>
        <input type="file" name="image" alt="画像" />
    </div>
</x-common-form>

@endsection