<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show</title>
  </head>
  <body>

    <!-- 編集画面へ遷移 -->
    <a href="{{ route('posts.edit-post', ['post' => $post->id]) }}">投稿を編集する</a>

    <!-- 削除 -->
    <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete-form">
      @method('DELETE')
      @csrf
      <button>投稿を削除する</button>
    </form>

    <p>{!! nl2br(e($post->address)) !!}</p>

    <p><a href="{{ route('dashboard') }}">マイページへ戻る</a></p>
  </body>

  <script>
    'use strict';

      const form = document.querySelector('#delete-form');
      form.addEventListener('submit', (e) => {
        e.preventDefault();

        if (confirm('本当に削除しますか?') === false) {
              return;
        }
        form.submit();
        });
  </script>
</html>