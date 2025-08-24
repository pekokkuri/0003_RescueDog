@extends('layouts.common')

@section('title', '詳細/RescueDog')

@section('content')

<div class="flex justify-center mt-4">
  <div class="border border-gray-400 rounded p-4 m-4 w-[1000px] h-auto">
    <!-----------------
      マップ表示
    ------------------->
    <div id="map" class="h-[250px] mt-4"></div>

    <script>
      const post = @json($post);
    </script>
    <script src="{{ url('/js/show.map.js') }}"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google_maps.api_key') }}&callback=initMap"
      async defer
    ></script>

    <div class="flex justify-between">
      <div class="pt-4 text-xl ml-[30px]">
        @if ($post->status === 1)
          <p class="text-red-500 font-bold">💡 ワンちゃんが見つかりました！</p>
        @else
          <p class="text-blue-500 font-bold">🔎 ワンちゃんを探しています...</p>
        @endif
      </div>

      <!-----------------
        編集・削除ボタン
      ------------------->
      @if($post->status === 0 && $post->user_id === auth()->id())
      <div class="flex gap-6 justify-end pt-4">

        <!-- 編集画面へ遷移 -->
        <a href="{{ route('posts.edit-post', ['post' => $post->id]) }}" class="bg-gray-500 hover:bg-gray-400 text-white text-center rounded px-4 py-2">
          投稿を編集する
        </a>

        <!-- 削除 -->
        <button class="bg-red-400 hover:bg-red-300 text-white text-center rounded px-4 py-2"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion')"
        >{{ __('投稿を削除する') }}</button>
    
        <x-modal name="confirm-post-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('posts.destroy', $post) }}" class="p-6">
                @csrf
                @method('delete')
    
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('本当に削除しますか？') }}
                </h2>
    
                <p class="mt-1 text-sm text-gray-600">
                    {!! __('この操作を行うと、投稿データが完全に削除され、元に戻すことはできません。') !!}
                </p>
    
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('キャンセル') }}
                    </x-secondary-button>
    
                    <x-danger-button class="ms-3">
                        {{ __('削除') }}
                    </x-danger-button>
                </div>
            </form>
          </x-modal>
        </button>
      </div>
      @endif
    </div>

    <!-----------------
        投稿内容を表示
    ------------------->
    <div class="flex m-8">
      
        <!-- 投稿画像を表示 -->
        @if ($post->image_path)
          <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="h-[300px] w-[300px]">
        @else
          <img src="/images/NoImage.png" alt="投稿された画像はありません" class="h-[300px] w-[300px]">
        @endif

        <div class="block">
          <div class="ml-6">
            <label>
              <div class="font-bold text-lg underline">場所</div>
              {!! nl2br(e(Str::contains($post->address, '付近') ? $post->address : $post->address . '付近')) !!}
            </label>
          </div>
          <br>
          <div class="ml-6">
            <label>
              <div class="font-bold text-lg underline">特徴</div>
              {!! nl2br(e($post->features)) !!}
            </label>
          </div>
        </div>
    </div>

      <!-- 「見つかった」ボタン -->
    @if ($post->status === 0 && $post->user_id === auth()->id())
      <div class="flex justify-end">
        <button class="bg-pink-500 hover:bg-pink-400 text-white text-center rounded px-4 py-2"
          x-data=""
          x-on:click.prevent="$dispatch('open-modal', 'confirm-post-found')"
        >{{ __('🤍見つかった') }}
        </button>
        <x-modal name="confirm-post-found" :show="$errors->userDeletion->isNotEmpty()" focusable>
          <form method="POST" action="{{ route('posts.found', $post) }}" class="p-6">
              @csrf
  
              <h2 class="text-lg font-medium text-gray-900">
                  {{ __('本当に見つかりましたか？') }}
              </h2>
  
              <p class="mt-1 text-sm text-gray-600">
                  {!! __('この操作を行うと、投稿データを編集することができなくなります。') !!}
              </p>
  
              <div class="mt-6 flex justify-end">
                  <x-secondary-button x-on:click="$dispatch('close')">
                      {{ __('キャンセル') }}
                  </x-secondary-button>
  
                  <x-danger-button class="ms-3">
                      {{ __('見つかった') }}
                  </x-danger-button>
              </div>
          </form>
        </x-modal>
      </div>
    @endif

    <!--************** 
      コメント
    *******************-->
    
    <!-- コメントはトグルで表示・非表示を管理 -->  
    <div class="mt-8">
      <h3 class="text-lg font-semibold"><コメント></h3>  
      @if ($post->comments->count() > 0)
        <button 
          class="text-blue-400 hover:text-blue-300 text-lg m-4 font-bold underline" 
          onclick="toggleCommentList()"
          id="comment-toggle"
        >
        コメントが{{ $post->comments->count() }}件あります...
        </button>
      @endif
      <!-- コメントを一覧表示 -->
      <div id="comment-list" class="{{ $post->comments->count() > 0 ? 'hidden' : '' }}">
        @forelse ($post->comments as $comment)
          <div class="border p-2 my-2">
            <div class="flex">
                @if ($comment->user && $comment->user->profile_image)
                  <img src="{{ asset('storage/' . $comment->user->profile_image) }}" class="w-12 h-12 rounded-full object-cover">
                @else
                  <img src="/profile_images/default_profile.png" class="w-12 h-12 rounded-full object-cover">
                @endif

                <div class="flex flex-col ml-4">
                  <p class="text-sm text-gray-700">{{ $comment->user->name }}</p>
                  <p class="text-xs text-gray-500">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        
                <p class="pt-4">{{ $comment->body }}</p>
                
      <!--*****************
            返信
      *******************-->

                <!-- 「返信」ボタン -->
                <div class="text-right mt-2">
                  <button 
                    class="text-gray-400 hover:text-gray-300 text-sm" 
                    onclick="toggleReplyForm({{ $comment->id }})"
                    title="返信する">
                    ↲
                  </button>
                </div>

                <!-- 返信フォーム（非表示⇒「↲」ボタンクリックで表示） -->
                <div id="reply-form-{{ $comment->id }}" class="ml-10 mt-2 hidden">
                  <form action="{{ route('replies.store', ['comment' => $comment->id]) }}" method="POST">
                    @csrf
                    <div class="flex">
                      <textarea
                        name="body"
                        placeholder="返信を書く..."
                        rows="1"
                        class="flex-grow border-0 border-b border-gray-400 hover:border-blue-500 hover:ring-0 bg-transparent"
                      ></textarea>
                      <button type="submit" class="text-blue-400 text-sm hover:text-blue-300 mt-4">送信</button>
                    </div>  
                  </form>
                </div>

                <!-- 返信一覧 -->
                @foreach ($comment->replies as $reply)
                  <div class="ml-10 mt-3 border-l-4 border-gray-300 pl-4">
                    <div class="flex items-center">
                      <img src="{{ asset('storage/' . optional($reply->user)->profile_image ?? 'profile_images/default_profile.png') }}"
                          class="w-8 h-8 rounded-full object-cover">
                      <div class="ml-2">
                        <p class="text-sm">{{ $reply->user->name }}</p>
                        <p class="text-gray-500 text-xs">{{ $reply->created_at->format('Y-m-d H:i') }}</p>
                        <p class="text-sm mt-1">{!! nl2br(e($reply->body)) !!}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
          </div>
        @empty
          <p class="text-gray-500">コメントはまだありません。</p>
        @endforelse
      </div>
    </div>
    <!-- コメント投稿フォーム -->
    @auth
    <form method="POST" action="{{ route('comments.store', ['post' => $post->id]) }}" class="mt-4">
      @csrf
      <textarea name="body" rows="3" class="w-full border rounded p-2" placeholder="コメントを書く..." required></textarea>
      <x-primary-button class="mt-2">送信</x-primary-button>
    </form>
    @endauth
  </div>
</div>


<script>
  function toggleCommentList() {
    const commentList = document.getElementById(`comment-list`);
    const commentToggle = document.getElementById('comment-toggle');

    commentList.classList.toggle('hidden');

    if (commentList.classList.contains('hidden')) {
      // 閉じているとき
      commentToggle.textContent = `コメントが{{ $post->comments->count() }}件あります`;
    } else {
      // 開いているとき
      commentToggle.textContent = 'コメントを非表示にする';
    }
  }

  function toggleReplyForm(commentId) {
    const form = document.getElementById(`reply-form-${commentId}`);
    if (form.classList.contains('hidden')) {
      form.classList.remove('hidden');
    } else {
      form.classList.add('hidden');
    }
  }
</script>


@endsection

