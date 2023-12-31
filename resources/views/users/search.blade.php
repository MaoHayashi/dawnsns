@extends('layouts.login')

@section('content')
<div class= "search">
  <form action="/searchUser" method="POST">
    @csrf
    <input type="text" name="username" class="username" placeholder="ユーザー名">
    <button type="submit" id="sbtm">
      <i class="fas fa-search"></i>
    </button>
  </form>
</div>

<div>
  @foreach($users as $user)
  <img src="/images/{{ $user->images }}" alt="">
  <p>{{ $user->username }}</p>
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
  @endforeach
</div>

@endsection
