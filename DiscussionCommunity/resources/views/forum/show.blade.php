@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" alt="64x64" src="{{ $discussion->user->avatar }}"
                             style="width: 64px; height: 64px">
                    </a>
                </div>
                <div class="media-center">
                    <h4> {{ $discussion->title }}
                        @if(\Illuminate\Support\Facades\Auth::check() &&
                        \Illuminate\Support\Facades\Auth::user()->id == $discussion->user_id)
                            <a class="btn btn-lg btn-danger pull-right"
                               href="/discussions/{{$discussion->id}}/edit" role="button">修改帖子</a></h4>
                    {{ $discussion->user->name }}
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main" id="post">
                {{--讨论展示区域--}}
                <div class="blog-post">
                    {!! $html !!}
                </div>
                <hr>
                {{--评论详情页的评论展示区域--}}
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64x64" src="{{$comment->user->avatar}}"
                                     style="width: 64px;height: 64px;">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach
                {{--为新添加一条评论进行展示--}}
                <hr>
                {{--添加评论区域--}}
                @if(\Illuminate\Support\Facades\Auth::check())
                    {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                    {!! Form::hidden('discussion_id', $discussion->id ) !!}
                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::submit('发表评论',['class'=>'btn btn-success pull-right']) !!}
                    </div>
                    <br><br><br><br><br><br><br><br><br>
                    {!! Form::close() !!}
                @else
                    <br><br><br>
                    <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
                    <br><br><br><br><br><br>
                @endif
            </div>
        </div>
    </div>
@stop