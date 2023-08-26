@extends('layouts.login')

@section('content')
<div>
  @foreach($followerIcons as $followerIcon)
  <a href='/follow_user/{{ $followerIcon->id }}'>
    <img src="/images/{{ $followerIcon->images }}" alt="">
  </a>
  @endforeach
</div>


<div>
  @foreach($followerPosts as $followerPost)
  <a href='/follow_user/{{ $followerPost->id }}'>
    <img src="/images/{{ $followerPost->images }}" alt="">
</a>
  <p>{{ $followerPost->username }}</p>
  <p>{{ $followerPost->posts }}</p>
  <p>{{ $followerPost->created_at }}</p>
  @endforeach
</div>

@endsection
