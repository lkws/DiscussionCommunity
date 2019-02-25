@extends('app')
@section('content')
    <br/>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action="/user/register" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="control-label">用户名:</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="请填写用户名">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">邮箱:</label>
                    <input id="email" name="email" class="form-control" placeholder="请填写正确邮箱">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">密码:</label>
                    <input id="password" name="password" class="form-control" placeholder="请填写密码">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label">确认密码:</label>
                    <input id="password_confirmation" name="password_confirmation" class="form-control"
                           placeholder="请再次填写密码">
                </div>
                <button type="submit" class="btn btn-success form-control">马上注册</button>
            </form>
        </div>
    </div>
@stop