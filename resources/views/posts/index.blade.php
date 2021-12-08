@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>おすすめユーザー</h2>
  <ul class="recommend_users">
    @forelse($recommended_users as $recommended_user)
      <li>
        <a href="{{route('users.show', $recommended_user)}}">
          {{$recommended_user->name}}
        </a>
        @if(Auth::user()->isFollowing($recommended_user))
          {{Form::open(['url'=>route('follows.destroy', $recommended_user), 'class' => 'follow'])}}
          {{Form::token()}}
          {{method_field('DELETE')}}
          {{Form::submit('フォロー解除')}}
          {{Form::close()}}
        @else
        {{Form::open(['url'=>route('follows.store', $recommended_user), 'class' => 'follow'])}}
        {{Form::token()}}
        {{Form::hidden('follow_id', $recommended_user->id)}}
        {{Form::submit('フォロー')}}
        {{Form::close()}}
        @endif
      </li>
    @empty
      <li>おすすめユーザーはいません。</li>
    @endforelse
  </ul>
  <a href="{{route('posts.create')}}">つぶやく</a>
  <ul class="posts">
      @forelse($posts as $post)
      <li class="post">
        <div class="post_content">
          <div class="post_body">
            <div class="post_body_heading">
              {{$post->user->name}}:
              ({{$post->created_at}})
            </div>
            <div class="post_body_main">
              <div class="post_body_main_body">
                {{$post->body}} 
              </div>
              <div class="post_body_main_img">
                @if($post->image !== '')
                  <img src="{{asset('storage/' . $post->image)}}">
                  <a href="{{route('posts.edit_image', $post)}}">画像を編集</a>
                @endif
              </div>
              <div class="post_body_main_tags">
                <ul>
                  @if($post->tags !== '')
                  @foreach($post->tags as $tag)
                    <li>#{{$tag->name}}</li>
                  @endforeach
                @endif
                </ul>
              </div>
            </div>
            
            <div class="post_body_footer">
              <a class="like_button">{{ $post->isLikedBy(Auth::user()) ? '♥' : '♡' }}</a>
              {{Form::open(['url'=>route('posts.toggle_like', $post), 'class' => 'like'])}}
              {{Form::token()}}
              {{method_field('PATCH')}}
              {{Form::close()}}
              [<a href="{{route('posts.edit', $post)}}">編集</a>]
              {{Form::open(['url'=>route('posts.destroy', $post), 'class' => 'delete' ])}}
              {{Form::token()}}
              {{method_field('DELETE')}}
              {{Form::submit('削除')}}
              {{Form::close()}}
            </div>
          </div>
          
          <div class="post_replies">
            <ul>
              @forelse($post->replies as $reply)
              <li>
                <div class="post_replies_body_heading">
                  {{$reply->user->name}}:
                </div>
                <div class="post_replies_body_main">
                  <div class="post_replies_body_main_body">
                    {{$reply->body}}
                  </div>
                  <div class="post_replies_body_main_img">
                    
                  </div>
                </div>
                <div class="post_replies_body_footer">
                  
                </div>
              </li>
              @empty
              <li>リプライはありません。</li>
              @endforelse
            </ul>
              {{Form::open(['url'=>route('replies.store')])}}
              {{Form::token()}}
              {{Form::hidden('post_id',$post->id)}}
              <label>
                リプライを追加:
                {{Form::text('body', null)}}
              </label>
              {{Form::submit('リプライを送信')}}
              {{Form::close()}}
              </li>
            @empty
            <li>つぶやきはありません。</li>
            @endforelse
  </ul>
  {{$posts->links()}}
  <script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>
@endsection