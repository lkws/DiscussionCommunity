@extends('app')
@section('content')
    @include('editor::head')
    <br>
    <div class="container">
        <div class="col-md-10 col-md-offset-1" role="main">
            {!! Form::open(['url'=>'/discussions']) !!}
            @include('forum.form')
            <div>
                {!! Form::submit('发表帖子', ['class'=>'btn btn-success  pull-right']) !!}
            </div>
            <br><br><br><br>
            {!! Form::close() !!}
        </div>
    </div>
@stop