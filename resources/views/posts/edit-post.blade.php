@extends('layouts.common')

@section('title', '編集/RescurDog')

@section('content')

<x-common-form
    formTitle="編集フォーム"
    submitLabel="編集完了"
    :backLink="route('posts.show', $post)"
>

<form id="post-form" method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="max-w-xl">
    @method('PATCH')
    @csrf
    <div class="m-4">
        
        <div class="m-4">
            <label class="block">画像：</label>
            <input type="file" name="image" alt="画像" />
        </div>

        <div class="m-4">
            <label>
                場所：
                <input 
                    type="text"
                    name="address"
                    id="address"
                    value="{{ old('address', $post->address) }}"
                    class="w-[500px] h-[30px]" />
            </label>

            <input type="hidden" name="lat" id="lat" value="{{ old('lat', $post->lat) }}"/>
            <input type="hidden" name="lng" id="lng" value="{{ old('lng', $post->lng) }}"/>

            <div id="error-message"></div>
        </div>
    </div>  
</form>  

</x-common-form>

@endsection