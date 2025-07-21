@extends('layouts.common')

@section('title', '投稿/RescueDog')

@section('content')
    
<x-common-form
    formTitle="投稿フォーム"
    submitLabel="投稿する"
    :backLink="route('posts.index')"
>

<form id="post-form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="max-w-xl">
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
                    class="w-[500px] h-[30px]" />
            </label>
                
            <input type="hidden" name="lat" id="lat" />
            <input type="hidden" name="lng" id="lng" />
  
            <div id="error-message"></div>

        </div>
        <div class="m-4">
            <label>
                特徴：
                <textarea class="w-[500px] h-[200px]"></textarea>
            </label>
        </div>
    </div>
</form>

</x-common-form>

@endsection
