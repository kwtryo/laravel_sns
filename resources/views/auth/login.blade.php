@extends('layouts.not_logged_in')
 
@section('content')
  <h1>ログイン</h1>
  
    {{Form::open(['url'=>route('login')])}}
    {{Form::token()}}
    <div>
        <label>
            メールアドレス:
            {{Form::email('email', null)}}
        </label>
    </div>
    <div>
        <label>
            パスワード:
            {{Form::password('password', null)}}
        </label>
    </div>
    {{Form::submit('ログイン')}}
    {{Form::close()}}
@endsection