@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

<p>User Name</p>
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
{{ $errors->first('username') }}

<p>Mail Address</p>
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ $errors->first('mail') }}

<p>Password</p>
{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}
{{ $errors->first('password') }}

<P>Password confirm</P>
{{ Form::label('パスワード確認') }}
{{ Form::text('password-confirm',null,['class' => 'input']) }}
{{ $errors->first('password-confirm') }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
