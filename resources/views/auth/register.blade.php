@extends('layouts.not_logged_in')
 
@section('content')

  <h1>新規ユーザー登録</h1>
  
    {{Form::open(['url'=>route('register')])}}
    {{Form::token()}}
    <div>
        <label>
            ユーザー名:
            {{Form::text('name', null)}}
        </label>
    </div>
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
    <div>
        <label>
            パスワード(確認用):
            {{Form::password('password_confirmation', null)}}
        </label>
    </div>
    {{Form::submit('登録')}}
     {{Form::close()}}


@endsection