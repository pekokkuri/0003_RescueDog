<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>show</title>
</head>
<body>
  <a href="{{ route('posts.edit-post', ['post' => $post->id]) }}">投稿を編集する</a>

  <p>{!! nl2br(e($post->address)) !!}</p>

  <p><a href="{{ route('dashboard') }}">マイページへ戻る</a></p>
</body>
</html>