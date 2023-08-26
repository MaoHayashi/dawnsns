@extends('layouts.login')

@section('content')
<div>
  @foreach($followIcons as $followIcon)
  <a href='/follow_user/{{ $followIcon->id }}'>
    <img src="/images/{{ $followIcon->images }}" alt="">
  </a>
  @endforeach
</div>


<div>
  @foreach($followPosts as $followPost)
  <a href='/follow_user/{{ $followPost->id }}'>
    <img src="/images/{{ $followPost->images }}" alt="">
</a>
  <p>{{ $followPost->username }}</p>
  <p>{{ $followPost->posts }}</p>
  <p>{{ $followPost->created_at }}</p>
  @endforeach
</div>

@endsection
