@extends('layouts.login')

@section('content')
<div id="">
  <img src="/images/{{ $user->images }}" alt="">
  <p>Name</p>
  <p>{{ $user->username }}</p>
  <p>Bio</p>
  <p>{{$user->bio}}</p>
  @if($followNumbers->contains('follow',$user->id))
  <form action="/unfollow" method="POST">
    @csrf
    @method('delete')
    <input type="hidden" name="followId" value="{{$user->id}}">
    <input type="submit" value="フォローはずす">
  </form>
  @else
  <form action="/follow" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$user->id}}">
    <input type="submit" value="フォローする">
  </form>
  @endif
</div>


<div>
  @foreach($posts as $post)
    <img src="/images/{{ $post->images }}" alt="">
  <p>{{ $post->username }}</p>
  <p>{{ $post->images }}</p>
  <p>{{ $post->posts }}</p>
  <p>{{ $post->created_at }}</p>
  @endforeach
</div>

@endsection
