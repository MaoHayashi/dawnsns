@extends('layouts.login')

@section('content')
<div class= "post">
  <form action="/createPost" method="POST">
    @csrf
    <textarea name="newPost" placeholder="何をつぶやこうか...?"></textarea>
    <input type="submit" value="投稿ボタン">

  </form>
</div>

<div>
  @foreach($posts as $post)
  <img src="/images/{{ $post->images }}" alt="">
  <p>{{ $post->username }}</p>
  <p>{{ $post->posts }}</p>
  <p>{{ $post->created_at }}</p>
  <!-- 編集ボタン -->
  <img src="/images/edit.png" alt="" class="editbtn" data-target="{{ $post->id }}">
  <!-- 削除ボタン -->
  <form action="/deletePost" method="POST">
    @csrf
    @method('delete')
    <input type="hidden" name="postId" value="{{ $post->id }}">
    <input type="image" src="images/trash.png" alt="" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
  </form>
  <div id="{{ $post->id }}" class="editForm">
    <form action="/updatePost" method="POST">
      @csrf
      @method('put')
      <textarea name="updatePost">{{$post->posts}}</textarea>
      <input type="hidden" name="upPost" value="{{$post->id}}">
      <input type="submit" value="投稿ボタン">
    </form>
  </div>
  @endforeach
</div>
@endsection
